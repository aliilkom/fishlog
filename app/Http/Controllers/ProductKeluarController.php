<?php

namespace App\Http\Controllers;

use App\Category;
use App\Customer;
use App\Exports\ExportProdukKeluar;
use App\Product;
use App\Product_Keluar;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use PDF;


class ProductKeluarController extends Controller
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

        $customers = Customer::orderBy('nama','ASC')
            ->where('user_id', $id)
            ->get()
            ->pluck('nama','id');

        $invoice_data = Product_Keluar::all()->where('user_id', $id);
        return view('gudang.product_keluar.index', compact('products','customers', 'invoice_data'));
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
            'customer_id'    => 'required',
            'jumlah'         => 'required',
            'pembayaran'     => 'required',
            'tanggal'        => 'required'
        ]);

        Product_Keluar::create($request->all());
        
        $product = Product::findOrFail($request->product_id);
        $product->jumlah -= $request->jumlah;
        $product->save();
       

        return response()->json([
            'success'    => true,
            'message'    => 'Stok Keluar Ditambah'
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
        $product_keluar = Product_Keluar::find($id);
        return $product_keluar;
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
            'customer_id'    => 'required',
            'jumlah'         => 'required',
            'pembayaran'     => 'required',
            'tanggal'        => 'required'
        ]);

        $product_keluar = Product_Keluar::findOrFail($id);
        $product_keluar->update($request->all());

        $product = Product::findOrFail($request->product_id);
        $product->jumlah -= $request->jumlah;
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
        Product_Keluar::destroy($id);

        return response()->json([
            'success'    => true,
            'message'    => 'Stok Keluar Dihapus'
        ]);
    }



    public function apiProductsOut(){
        $id = Auth::id();
        $product = Product_Keluar::all()->where('user_id', $id);

        return Datatables::of($product)
            ->addColumn('products_name', function ($product){
                return $product->product->nama;
            })
            ->addColumn('customer_name', function ($product){
                return $product->customer->nama;
            })
            ->addColumn('action', function($product){
                return 
                    // '<a href="#" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-eye-open"></i> Show</a> ' .
                    '<a onclick="editForm('. $product->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Ubah</a> ' .
                    '<a onclick="deleteData('. $product->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Hapus</a>';
            })
            ->rawColumns(['products_name', 'customer_name','action'])->make(true);

    }

    public function exportProductKeluarAll()
    {
        $product_keluar = Product_Keluar::all();
        $pdf = PDF::loadView('gudang.product_keluar.productKeluarAllPDF',compact('product_keluar'));
        return $pdf->download('Data Stok Keluar.pdf');
    }

    public function exportProductKeluar($id)
    {
        $product_keluar = Product_Keluar::findOrFail($id);
        $pdf = PDF::loadView('gudang.product_keluar.productKeluarPDF', compact('product_keluar'));
        return $pdf->download($product_keluar->id.' Struk Stok Keluar.pdf');
    }

    public function exportExcel()
    {
        return (new ExportProdukKeluar)->download('Data Stok Keluar.xlsx');
    }
}
