<?php

namespace App\Http\Controllers;

use App\Warehouse;
use App\Category;
use App\Merk;
use App\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;

class MoveController extends Controller
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
        $warehouse = Warehouse::orderBy('nama','ASC')
            ->where('user_id', $id)
            ->get()
            ->pluck('nama','id');

        $warehouse2 = Warehouse::orderBy('nama','ASC')
            ->where('user_id', $id)
            ->get()
            ->pluck('nama','id');

        $move = Product::all();
        return view('gudang.moves.index', compact('warehouse','warehouse2'));
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
           
        ]);

        Product::create($request->all());
        
        // $move = Product::findOrFail($request->product_id);
        // $move->jumlah -= $request->jumlah;
        // $move->save();
       

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
        $move = Product::find($id);
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
            
        ]);

        $move = Product::findOrFail($id);
        $move->update($request->all());

        // $move = Product::findOrFail($request->product_id);
        // $move->jumlah -= $request->jumlah;
        // $move->update();

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
        Product::destroy($id);

        return response()->json([
            'success'    => true,
            'message'    => 'Stok Keluar Dihapus'
        ]);
    }



    public function apiMoves(){
        $id = Auth::id();
        $move = Product::all()->where('user_id', $id);

        return Datatables::of($move)
            ->addColumn('warehouse_1', function ($move){
                return $move->warehouse->nama;
            })
            ->addColumn('warehouse_2', function ($move){
                return $move->warehouse->nama;
            })
            ->addColumn('action', function($move){
                return 
                    // '<a href="#" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-eye-open"></i> Show</a> ' .
                    '<a onclick="editForm('. $move->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Ubah</a> ' .
                    '<a onclick="deleteData('. $move->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Hapus</a>';
            })
            ->rawColumns(['warehouse_1','warehouse_2','action'])->make(true);

    }
}
