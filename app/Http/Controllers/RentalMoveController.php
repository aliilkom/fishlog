<?php

namespace App\Http\Controllers;

use DB;
use App\Warehouse;
use App\Category;
use App\Merk;
use App\Product;
use App\Move;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;

class RentalMoveController extends Controller
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
        $product1 = DB::table('products')
            ->where('products.user_id', $id)
            ->where('products.manajemen', 'rental')
            ->join('warehouses', 'products.warehouse_id', '=', 'warehouses.id')
            ->select('products.*','warehouses.nama')
            ->selectRaw("CONCAT (products.nama, ' stok = ', products.jumlah, ' dari ', warehouses.nama) as joins")
            ->orderBy('joins','ASC')
            ->get()
            ->pluck('joins','id');

        $product2 = DB::table('products')
            ->where('products.user_id', $id)
            ->where('products.manajemen', 'rental')
            ->join('warehouses', 'products.warehouse_id', '=', 'warehouses.id')
            ->select('products.*','warehouses.nama')
            ->selectRaw("CONCAT (products.nama, ' stok = ', products.jumlah, ' dari ', warehouses.nama) as joins")
            ->orderBy('joins','ASC')
            ->get()
            ->pluck('joins','id');

        return view('rental.moves.index', compact('product1','product2'));
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
            'product1_id'     => 'required',
            'product2_id'     => 'required',
            'jumlah'         => 'required',
            'tanggal'        => 'required'
        ]);

        Move::create($request->all());

        $product1 = Product::findOrFail($request->product1_id);
        $product1->jumlah -= $request->jumlah;
        $product1->save();

        $product2 = Product::findOrFail($request->product2_id);
        $product2->jumlah += $request->jumlah;
        $product2->save();

        return response()->json([
            'success'    => true,
            'message'    => 'Pindah Barang Ditambah'
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
        $move = Move::find($id);
        return $move;
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
            'product1_id'     => 'required',
            'product2_id'     => 'required',
            'jumlah'         => 'required',
            'tanggal'        => 'required'
        ]);

        $move = Move::findOrFail($id);
        $move->update($request->all());


        // $product1 = Product::findOrFail($request->product1_id);
        // $product1->jumlah -= $request->jumlah;
        // $product1->update();

        // $product2 = Product::findOrFail($request->product2_id);
        // $product2->jumlah += $request->jumlah;
        // $product2->update();


        return response()->json([
            'success'    => true,
            'message'    => 'Pindah Barang Diubah'
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
        Move::destroy($id);

        return response()->json([
            'success'    => true,
            'message'    => 'Pindah Barang Dihapus'
        ]);
    }



    public function apiRentalMoves(){
        $id = Auth::id();
        $move = Move::orderBy('tanggal','DSC')
            ->where('user_id', $id)
            ->where('manajemen', 'rental');

        return Datatables::of($move)
            ->addColumn('products1_name', function ($move){
                return $move->product1->nama.' dari '.$move->product1->warehouse->nama;
            })
            ->addColumn('products2_name', function ($move){
                return $move->product2->nama.' dari '.$move->product2->warehouse->nama;;
            })
            ->addColumn('action', function($move){
                return 
                    // '<a href="#" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-eye-open"></i> Show</a> ' .
                    // '<a onclick="editForm('. $move->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Ubah</a> ' .
                    '<a onclick="deleteData('. $move->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Hapus</a>';
            })
            ->rawColumns(['products1_name','products2_name','action'])->make(true);

    }
}
