<?php

namespace App\Http\Controllers;

use App\Warehouse;
use App\Category;
use App\Merk;
use App\Product;
use App\Supplier;
use App\Customer;
use App\Product_Masuk;
use App\Product_Keluar;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;

class RentalStockController extends Controller
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
        return view('rental.stocks.index');
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
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
    }

    public function apiRentalStocks(){
        $id = Auth::id();
        $product = Product::all()
        ->where('user_id', $id)
        ->where('manajemen', 'rental');

        return Datatables::of($product)
            ->addColumn('warehouse_nama', function ($product){
                return $product->warehouse->nama;
            })
            ->addColumn('category_name', function ($product){
                return $product->category->name;
            })
            ->addColumn('merk_name', function ($product){
                return $product->merk->name;
            })
            ->addColumn('action', function($product){
                return '<a href="/rentalbarang/detail/'.$product->id.'" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-eye-open"></i> Detail</a> ';
                    
            })
           
            ->rawColumns(['warehouse_nama','category_name','merk_name','action'])->make(true);

    }
}
