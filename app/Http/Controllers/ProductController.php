<?php

namespace App\Http\Controllers;

use App\Warehouse;
use App\Category;
use App\Merk;
use App\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
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
        $warehouse = Warehouse::orderBy('nama','ASC')
            ->get()
            ->pluck('nama','id');
        
        $category = Category::orderBy('name','ASC')
            ->get()
            ->pluck('name','id');

        $merk = Merk::orderBy('name','ASC')
            ->get()
            ->pluck('name','id');

        $product = Product::all();
        return view('products.index', compact('warehouse','category','merk'));
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
        $warehouse = Warehouse::orderBy('nama','ASC')
            ->get()
            ->pluck('nama','id');
        
        $category = Category::orderBy('name','ASC')
            ->get()
            ->pluck('name','id');
        
        $merk = Merk::orderBy('name','ASC')
            ->get()
            ->pluck('name','id');

        $this->validate($request , [
            'nama'          => 'required|string',
            'sku'           => 'required',
            'satuan'        => 'required',
            'spesifikasi'   => 'required',
            // 'image'         => 'required',
            'warehouse_id'  => 'required',
            'category_id'   => 'required',
            'merk_id'       => 'required',

           
        ]);

        $input = $request->all();
        $input['image'] = null;

        if ($request->hasFile('image')){
            $input['image'] = '/upload/products/'.str_slug($input['nama'], '-').'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('/upload/products/'), $input['image']);
        }

        Product::create($input);

        return response()->json([
            'success' => true,
            'message' => 'Barang Ditambah'
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
        $warehouse = Warehouse::orderBy('nama','ASC')
            ->get()
            ->pluck('nama','id');
        
        $category = Category::orderBy('name','ASC')
            ->get()
            ->pluck('name','id');

        $merk = Merk::orderBy('name','ASC')
            ->get()
            ->pluck('name','id');
            
        $product = Product::find($id);
        return $product;
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
        $warehouse = Warehouse::orderBy('nama','ASC')
            ->get()
            ->pluck('nama','id');
        
        $category = Category::orderBy('name','ASC')
            ->get()
            ->pluck('name','id');

        $merk = Merk::orderBy('name','ASC')
            ->get()
            ->pluck('name','id');

        $this->validate($request , [
            'nama'          => 'required|string',
            'sku'           => 'required',
            'satuan'        => 'required',
            'spesifikasi'   => 'required',
            // 'image'         => 'required',
            'warehouse_id'  => 'required',
            'category_id'   => 'required',
            'merk_id'       => 'required',

        ]);

        $input = $request->all();
        $produk = Product::findOrFail($id);

        $input['image'] = $produk->image;

        if ($request->hasFile('image')){
            if (!$produk->image == NULL){
                unlink(public_path($produk->image));
            }
            $input['image'] = '/upload/products/'.str_slug($input['nama'], '-').'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('/upload/products/'), $input['image']);
        }

        $produk->update($input);

        return response()->json([
            'success' => true,
            'message' => 'Barang Diubah'
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
        $product = Product::findOrFail($id);

        if (!$product->image == NULL){
            unlink(public_path($product->image));
        }

        Product::destroy($id);

        return response()->json([
            'success' => true,
            'message' => 'Barang Dihapus'
        ]);
    }

    public function apiProducts(){
        $product = Product::all();

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
            ->addColumn('show_photo', function($product){
                if ($product->image == NULL){
                    return 'No Image';
                }
                return '<img class="rounded-square" width="50" height="50" src="'. url($product->image) .'" alt="">';
            })
            ->addColumn('action', function($product){
                return 
                    // '<a href="#" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-eye-open"></i> Show</a> ' .
                    '<a onclick="editForm('. $product->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a onclick="deleteData('. $product->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            })
            ->rawColumns(['warehouse_nama','category_name','merk_name','show_photo','action'])->make(true);

    }
}