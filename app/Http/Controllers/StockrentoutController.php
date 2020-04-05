<?php

namespace App\Http\Controllers;

use App\Product;
use App\Stockrentout;
use App\Renter;
use App\Exports\ExportStockrentout;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use PDF;


class StockrentoutController extends Controller
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
            ->get()
            ->pluck('nama','id');

        $renters = Renter::orderBy('nama','ASC')
            ->where('user_id', $id)
            ->get()
            ->pluck('nama','id');

        $invoice_data = Stockrentout::all()->where('user_id', $id);
        return view('stockrentouts.index', compact('products','renters', 'invoice_data'));
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
            'jumlahsrent'         => 'required',
            'pembayaran'     => 'required',
            'tanggal'        => 'required'
        ]);

        Stockrentout::create($request->all());
        
        $product = Product::findOrFail($request->product_id);
        $product->jumlahsrent -= $request->jumlahsrent;
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
        $Stockrentout = Stockrentout::find($id);
        return $Stockrentout;
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
            'jumlahsrent'         => 'required',
            'pembayaran'     => 'required',
            'tanggal'        => 'required'
        ]);

        $Stockrentout = Stockrentout::findOrFail($id);
        $Stockrentout->update($request->all());

        $product = Product::findOrFail($request->product_id);
        $product->jumlahsrent -= $request->jumlahsrent;
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
        Stockrentout::destroy($id);

        return response()->json([
            'success'    => true,
            'message'    => 'Stok Keluar Dihapus'
        ]);
    }



    public function apiStockrentouts(){
        $id = Auth::id();
        $product = Stockrentout::all()->where('user_id', $id);

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

    public function exportStockrentoutAll()
    {
        $Stockrentout = Stockrentout::all();
        $pdf = PDF::loadView('stockrentouts.StockrentoutAllPDF',compact('Stockrentout'));
        return $pdf->download('Data Stok Rental Keluar.pdf');
    }

    public function exportStockrentout($id)
    {
        $Stockrentout = Stockrentout::findOrFail($id);
        $pdf = PDF::loadView('stockrentouts.StockrentoutPDF', compact('Stockrentout'));
        return $pdf->download($Stockrentout->id.' Struk Stok Rental Keluar.pdf');
    }

    public function exportExcel()
    {
        return (new ExportStockrentout)->download('Data Stok Rental Keluar.xlsx');
    }
}
