<?php

namespace App\Http\Controllers;

use App\User;
use App\Warehouse;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;

class RentalController extends Controller
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
        $user = User::orderBy('name','ASC')
            ->get()
            ->pluck('name','id');
            
        $warehouse = Warehouse::all();
        return view('rentals.index', compact('user'));
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
        $user = User::orderBy('name','ASC')
            ->get()
            ->pluck('name','id');


        $this->validate($request , [
            
        ]);

        $input = $request->all();
        $input['image'] = null;

        if ($request->hasFile('image')){
            $input['image'] = '/upload/gudang/'.str_slug($input['nama'], '-').'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('/upload/gudang/'), $input['image']);
        }

        Warehouse::create($input);

        return response()->json([
            'success' => true,
            'message' => 'Rental Ditambah'
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
        $user = User::orderBy('name','ASC')
            ->get()
            ->pluck('name','id');

        $warehouse = Warehouse::find($id);
        return $warehouse;
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
        $user = User::orderBy('name','ASC')
            ->get()
            ->pluck('name','id');

        $this->validate($request , [
            
        ]);

        $input = $request->all();
        $warehouse = Warehouse::findOrFail($id);

        $input['image'] = $warehouse->image;

        if ($request->hasFile('image')){
            if (!$warehouse->image == NULL){
                unlink(public_path($warehouse->image));
            }
            $input['image'] = '/upload/gudang/'.str_slug($input['nama'], '-').'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('/upload/gudang/'), $input['image']);
        }

        $warehouse->update($input);

        return response()->json([
            'success' => true,
            'message' => 'Rental Diubah'
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
        $warehouse = Warehouse::findOrFail($id);

        if (!$warehouse->image == NULL){
            unlink(public_path($warehouse->image));
        }

        Warehouse::destroy($id);

        return response()->json([
            'success' => true,
            'message' => 'Rental Dihapus'
        ]);
    }

    public function apiRentals(){
        $id = Auth::id();
        $warehouse = Warehouse::all()->where('user_id', $id);

        return Datatables::of($warehouse)
            ->addColumn('user_name', function ($warehouse){
                return $warehouse->user->name;
            })
            ->addColumn('show_photo', function($warehouse){
                if ($warehouse->image == NULL){
                    return 'No Image';
                }
                return '<img class="rounded-square" width="50" height="50" src="'. url($warehouse->image) .'" alt="">';
            })
            ->addColumn('action', function($warehouse){
                return 
                    // '<a href="#" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-eye-open"></i> Show</a> ' .
                    '<a onclick="editForm('. $warehouse->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Rental</a> ';
                    // '<a onclick="deleteData('. $warehouse->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Hapus</a>';
            })
            ->rawColumns(['user_name','show_photo','action'])->make(true);

    }
}
