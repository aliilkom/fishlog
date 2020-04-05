<?php

namespace App\Http\Controllers;


use App\Exports\ExportSuppliers;
use App\Imports\SuppliersImport;
use App\Supplier;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Excel;
use PDF;


class SupplierController extends Controller
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
        $suppliers = Supplier::all();
        return view('suppliers.index');
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
            'nama'      => 'required',
            'alamat'    => 'required',
            'email'     => 'required|unique:suppliers',
            'telepon'   => 'required',
        ]);

        $input = $request->all();
        $input['image'] = null;

        if ($request->hasFile('image')){
            $input['image'] = '/upload/penyuplai/'.str_slug($input['nama'], '-').'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('/upload/penyuplai/'), $input['image']);
        }

        Supplier::create($input);

        return response()->json([
            'success'    => true,
            'message'    => 'Penyuplai Ditambah'
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
        $supplier = Supplier::find($id);
        return $supplier;
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
            'nama'      => 'required|string',
            'alamat'    => 'required',
            'email'     => 'required',
            'telepon'   => 'required',
        ]);

        $input = $request->all();
        $supplier = Supplier::findOrFail($id);

        $input['image'] = $supplier->image;

        if ($request->hasFile('image')){
            if (!$supplier->image == NULL){
                unlink(public_path($supplier->image));
            }
            $input['image'] = '/upload/penyuplai/'.str_slug($input['nama'], '-').'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('/upload/penyuplai/'), $input['image']);
        }

        $supplier->update($input);

        return response()->json([
            'success'    => true,
            'message'    => 'Penyuplai Diubah'
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
        $supplier = Supplier::findOrFail($id);

        if (!$supplier->image == NULL){
            unlink(public_path($supplier->image));
        }

        Supplier::destroy($id);

        return response()->json([
            'success'    => true,
            'message'    => 'Peyuplai Dihapus'
        ]);
    }

    public function apiSuppliers()
    {
        $id = Auth::id();
        $suppliers = Supplier::all()->where('user_id', $id);

        return Datatables::of($suppliers)
            ->addColumn('show_photo', function($suppliers){
                if ($suppliers->image == NULL){
                    return 'No Image';
                }
                return '<img class="rounded-square" width="50" height="50" src="'. url($suppliers->image) .'" alt="">';
            })
            ->addColumn('action', function($suppliers){
                return 
                    // '<a href="#" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-eye-open"></i> Show</a> ' .
                    '<a onclick="editForm('. $suppliers->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Ubah</a> ' .
                    '<a onclick="deleteData('. $suppliers->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Hapus</a>';
            })
            ->rawColumns(['show_photo','action'])->make(true);
    }

    public function ImportExcel(Request $request)
    {
        //Validasi
        $this->validate($request, [
            'file' => 'required|mimes:xls,xlsx'
        ]);

        if ($request->hasFile('file')) {
            //UPLOAD FILE
            $file = $request->file('file'); //GET FILE
            Excel::import(new SuppliersImport, $file); //IMPORT FILE
            return redirect()->back()->with(['success' => 'Upload file data suppliers !']);
        }

        return redirect()->back()->with(['error' => 'Please choose file before!']);
    }

    public function exportSuppliersAll()
    {
        $suppliers = Supplier::all();
        $pdf = PDF::loadView('suppliers.SuppliersAllPDF',compact('suppliers'));
        return $pdf->download('suppliers.pdf');
    }

    public function exportExcel()
    {
        return (new ExportSuppliers)->download('suppliers.xlsx');
    }
}
