<?php

namespace App\Http\Controllers;

use DB;
use App\Renter;
use App\Product;
use App\Warehouse;
use App\Stockrentin;
use App\Stockrentout;
use App\Exports\ExportRenters;
use App\Imports\RentersImport;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Excel;
use PDF;

class BillController extends Controller
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

            $first = DB::table('stockrentins');

            $transaksi = DB::table('stockrentouts')
            ->union($first);

            $join1 = DB::table('products')
            
                ->joinSub($transaksi, 'tr', function ($join) {
                    $join->on('products.id', '=', 'tr.product_id');
                })
                ->select('products.nama as barang', 'products.jumlah as stok', 'products.satuan', 
                'products.tagihan', 'products.bysewa', 'products.bybongkar', 'products.bymuat', 
                'tr.jumlah as tr_jml', 'tr.tanggal as tr_tgl', 'tr.keterangan as tr_ket', 'tr.renter_id');

            $join2 = DB::table('renters')
            
                ->joinSub($join1, 'j1', function ($join) {
                    $join->on('renters.id', '=', 'j1.renter_id');
                })
                ->select('renters.id', 'renters.user_id', 'renters.nama', 'j1.*')
                ->get();

            

        return view('rental.bills.index', compact('join2'));
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

    public function apiRenters()
    {
        
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
