<?php

namespace App\Http\Controllers;


use App\Exports\ExportProdukMasuk;
use App\Product;
use App\Product_Masuk;
use App\Supplier;
use PDF;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;


class ProductMasukController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin,pemilik,manajer');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::id();
        $products = Product::orderBy('nama','ASC')
            ->where('user_id', $id)
            ->where('manajemen', 'gudang')
            ->get()
            ->pluck('nama','id');

        $suppliers = Supplier::orderBy('nama','ASC')
            ->where('user_id', $id)
            ->get()
            ->pluck('nama','id');

        $invoice_data = Product_Masuk::all()->where('user_id', $id);
        return view('gudang.product_masuk.index', compact('products','suppliers','invoice_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'product_id'     => 'required',
            'supplier_id'    => 'required',
            'jumlah'         => 'required',
            'pembayaran'     => 'required',
            'tanggal'        => 'required'
        ]);

        Product_Masuk::create($request->all());

        $product = Product::findOrFail($request->product_id);
        $product->jumlah += $request->jumlah;
        $product->save();

        return response()->json([
            'success'    => true,
            'message'    => 'Stok Masuk Ditambah'
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product_masuk = Product_Masuk::find($id);
        return $product_masuk;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'product_id'     => 'required',
            'supplier_id'    => 'required',
            'jumlah'         => 'required',
            'pembayaran'     => 'required',
            'tanggal'        => 'required'
        ]);

        $product_masuk = Product_Masuk::findOrFail($id);
        $product_masuk->update($request->all());

        $product = Product::findOrFail($request->product_id);
        $product->jumlah += $request->jumlah;
        $product->update();

        return response()->json([
            'success'    => true,
            'message'    => 'Stok Keluar Diubah'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product_Masuk::destroy($id);

        return response()->json([
            'success'    => true,
            'message'    => 'Stok Keluar Dihapus'
        ]);
    }



    public function apiProductsIn(){
        $id = Auth::id();
        $product = Product_Masuk::all()->where('user_id', $id);

        return Datatables::of($product)
            ->addColumn('products_name', function ($product){
                return $product->product->nama;
            })
            ->addColumn('stok', function ($product){
                return $product->product->jumlah;
            })
            ->addColumn('supplier_name', function ($product){
                return $product->supplier->nama;
            })
            ->addColumn('action', function($product){
                return 
                    // '<a href="#" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-eye-open"></i> Show</a> ' .
                    '<a onclick="editForm('. $product->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Ubah</a> ' .
                    '<a onclick="deleteData('. $product->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Hapus</a> ';


            })
            ->rawColumns(['products_name', 'stok', 'supplier_name','action'])->make(true);

    }

    public function exportProductMasukAll()
    {
        $product_masuk = Product_Masuk::all();
        $pdf = PDF::loadView('gudang.product_masuk.productMasukAllPDF',compact('product_masuk'));
        return $pdf->download('Data Stok Masuk.pdf');
    }

    public function exportProductMasuk($id)
    {
        $product_masuk = Product_Masuk::findOrFail($id);
        $pdf = PDF::loadView('gudang.product_masuk.productMasukPDF', compact('product_masuk'));
        return $pdf->download($product_masuk->id.' Struk Stok Masuk.pdf');
    }

    public function exportExcel()
    {
        return (new ExportProdukMasuk)->download('Data Stok Masuk.xlsx');
    }
}
