<?php

namespace App\Http\Controllers;


use App\Renter;
use App\Stockrentin;
use App\Stockrentout;
use App\Exports\ExportRenters;
use App\Imports\RentersImport;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Excel;
use PDF;

class RenterController extends Controller
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
        $Renters = Renter::all();
        return view('rental.renters.index');
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
            'telepon'   => 'required',
        ]);

        $input = $request->all();
        // $input['image'] = null;

        if ($request->hasFile('image')){
            $input['image'] = '/upload/penyewa/'.str_slug($input['nama'], '-').'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('/upload/penyewa/'), $input['image']);
        }

        Renter::create($input);

        return response()->json([
            'success'    => true,
            'message'    => 'Penyewa Ditambah'
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
      
        $renter = Renter::find($id);
        $productin = Stockrentin::where('renter_id', $id)->get();
        $productout = Stockrentout::where('renter_id', $id)->get();
        
        $transaksi = Stockrentin::where('renter_id', $id)
        ->union($productout = Stockrentout::where('renter_id', $id))
        ->orderBy('tanggal','DSC')
        ->get();
            

        return view('rental.renters.detail', compact('renter','productout', 'productin', 'transaksi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Renter = Renter::find($id);
        return $Renter;
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
            'telepon'   => 'required',
        ]);
        $input = $request->all();
        $Renter = Renter::findOrFail($id);

        $input['image'] = $Renter->image;

        if ($request->hasFile('image')){
            if (!$Renter->image == NULL){
                unlink(public_path($Renter->image));
            }
            $input['image'] = '/upload/penyewa/'.str_slug($input['nama'], '-').'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('/upload/penyewa/'), $input['image']);
        }

        $Renter->update($input);

        return response()->json([
            'success'    => true,
            'message'    => 'Penyewa Diubah'
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
        $Renter = Renter::findOrFail($id);

        if (!$Renter->image == NULL){
            unlink(public_path($Renter->image));
        }

        Renter::destroy($id);


        return response()->json([
            'success'    => true,
            'message'    => 'Penyewa Dihapus'
        ]);
    }

    public function apiRenters()
    {
        $id = Auth::id();
        $Renter = Renter::all()->where('user_id', $id);

        return Datatables::of($Renter)
            ->addColumn('show_photo', function($Renter){
                if ($Renter->image == NULL){
                    return 'No Image';
                }
                return '<img class="rounded-square" width="50" height="50" src="'. url($Renter->image) .'" alt="">';
            })
            ->addColumn('action', function($Renter){
                return 
                
                    '<a href="/penyewa/detail/'.$Renter->id.'" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-eye-open"></i> Detail</a> ' .
                    '<a onclick="editForm('. $Renter->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Ubah</a> ' .
                    '<a onclick="deleteData('. $Renter->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Hapus</a>';
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
            Excel::import(new RentersImport, $file); //IMPORT FILE
            return redirect()->back()->with(['success' => 'Upload file data Renters !']);
        }

        return redirect()->back()->with(['error' => 'Please choose file before!']);
    }


    public function exportRentersAll()
    {
        $Renters = Renter::all();
        $pdf = PDF::loadView('Renters.RentersAllPDF',compact('Renters'));
        return $pdf->download('Renters.pdf');
    }

    public function exportExcel()
    {
        return (new ExportRenters)->download('Renters.xlsx');
    }
}
