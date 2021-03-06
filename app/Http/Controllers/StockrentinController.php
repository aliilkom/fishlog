<?php

namespace App\Http\Controllers;

use App\Product;
use App\Renter;
use App\Stockrentin;
use App\Exports\ExportStockrentin;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use PDF;

class StockrentinController extends Controller
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
            ->where('manajemen', 'rental')
            ->get()
            ->pluck('nama','id');

        $renters = Renter::orderBy('nama','ASC')
            ->where('user_id', $id)
            ->get()
            ->pluck('nama','id');

        $invoice_data = Stockrentin::all()->where('user_id', $id);
        return view('rental.stockrentins.index', compact('products','renters', 'invoice_data'));
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
            'renter_id'    => 'required',
            'jumlah'        => 'required',
            'tanggal'        => 'required'
        ]);

        Stockrentin::create($request->all());
        
        $product = Product::findOrFail($request->product_id);
        $product->jumlah_sebelumnya = $product->jumlah;
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
        $Stockrentin = Stockrentin::find($id);
        return $Stockrentin;
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
            'renter_id'    => 'required',
            'jumlah'         => 'required',
            'tanggal'        => 'required'
        ]);

        $Stockrentin = Stockrentin::findOrFail($id);
        $Stockrentin->update($request->all());

        $product = Product::findOrFail($request->product_id);
        $product->jumlah_sebelumnya = $product->jumlah;
        $product->jumlah += $request->jumlah;
        $product->update();

        return response()->json([
            'success'    => true,
            'message'    => 'Stok Masuk Diubah'
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
        Stockrentin::destroy($id);

        return response()->json([
            'success'    => true,
            'message'    => 'Stok Masuk Dihapus'
        ]);
    }



    public function apiStockrentins(){
        $id = Auth::id();
        $product = Stockrentin::all()->where('user_id', $id);

        return Datatables::of($product)
            ->addColumn('products_name', function ($product){
                return $product->product->nama;
            })
            ->addColumn('renter_name', function ($product){
                return $product->renter->nama;
            })
            ->addColumn('action', function($product){
                return 
                    // '<a href="#" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-eye-open"></i> Show</a> ' .
                    '<a onclick="editForm('. $product->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Ubah</a> ' .
                    '<a onclick="deleteData('. $product->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Hapus</a>';
            })
            ->rawColumns(['products_name','renter_name','action'])->make(true);

    }

    public function exportStockrentinAll()
    {
        $Stockrentin = Stockrentin::all();
        $pdf = PDF::loadView('rental.stockrentins.StockrentinAllPDF',compact('Stockrentin'));
        return $pdf->download('Data Stok Rental Masuk.pdf');
    }

    public function exportStockrentin($id)
    {
        $Stockrentin = Stockrentin::findOrFail($id);
        $pdf = PDF::loadView('rental.stockrentins.StockrentinPDF', compact('Stockrentin'));
        return $pdf->download($Stockrentin->id.' Struk Stok Rental Masuk.pdf');
    }

    public function exportExcel()
    {
        return (new ExportStockrentin)->download('Data Stok Rental Masuk.xlsx');
    }
}
