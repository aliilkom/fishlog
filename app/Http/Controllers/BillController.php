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
use Carbon\Carbon;

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
        return view('rental.bills.index');
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

    public function apiBills()
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
                'tr.jumlah as tr_jml','tr.tanggal as tr_tgl', 'tr.keterangan as tr_ket', 'tr.renter_id');

            $join2 = DB::table('renters')
            
                ->joinSub($join1, 'j1', function ($join) {
                    $join->on('renters.id', '=', 'j1.renter_id');
                })
                ->select('renters.id', 'renters.user_id', 'renters.nama', 'j1.*')
                ->get();
            $j=count($join2);
            $stok=0;
            $waktuSimpan=0;
            $now=Carbon::now();
            $tagihanTotal[] = 0;
            $tagihanSewa[$j]=0;
            $tagihanBongkar[$j]=0;
            $tagihanMuat[$j]=0;
            foreach($join2 as $i){
                // if($join2[$j-1]->tr_ket === "Memasukkan Barang"){

                    $tes = Carbon::parse($join2[$j-1]->tr_tgl);
                    $waktuSimpan = $tes->diffInDays($now);
                    $i->waktu_simpan = $waktuSimpan;
                    $stok= $join2[$j-1]->tr_jml;
                    $tagihanBongkar[$j-1] = ($stok*$join2[$j-1]->bybongkar);
                    $tagihanSewa[$j-1] = ($join2[$j-1]->bysewa*$waktuSimpan*$stok);
                    $i->tagihanBongkar = ($join2[$j-1]->bybongkar*$stok);
                    $i->tagihanSewa = ($join2[$j-1]->bysewa*$waktuSimpan*$stok);
                    // $i->tagihanMuat = ($join2[$j-1]->bymuat*$stok);
                    // $join[$j]->stok
                    $tagihanTotalBongkar[$j-1] = $tagihanBongkar[$j-1]+$tagihanBongkar[$j];
                    $tagihanTotalSewa[$j-1] = $tagihanSewa[$j-1]+$tagihanSewa[$j];
                    if($join2[$j-1]->tr_ket === "Mengeluarkan Barang"){
                        $tagihanMuat[$j-1] = ($join2[$j-1]->bymuat*$stok);
                        $i->flag = "Benar";
                        $tagihanTotalMuat[$j-1] = $tagihanMuat[$j-1]+$tagihanMuat[$j];
                    }
                    else{
                        $tagihanTotalMuat[$j-1] = 0;
                    }
                    $j--;
                    // echo($tagihanTotal[$j]);
                // }
            }
            $j=count($join2);
            $idx=0;
            foreach($join2 as $k){
                // if($join2[$j-1]->tr_ket === "Memasukkan Barang"){
                    // $k->totalTagihan = $tagihanTotalSewa[$j-1]+$tagihanTotalBongkar[$j-1];
                    $k->totalTagihan = $tagihanTotalSewa[$idx]+$tagihanTotalBongkar[$idx]+$tagihanTotalMuat[$idx];
                    // $k->tagihanMuat = $tagihanMuat[$idx];
                    // if($join2[$idx]->tr_ket === "Mengeluarkan Barang"){
                    //     $k->flag = "Benar";
                    //     $k->totalTagihan = $k->totalTagihan+$k->tagihanMuat;
                    // }
                    $idx++;
                    $j--;
                // }
            }
            // foreach ($join2 as $l) {
            //     $l->totalTagihanFinal = 
            //     # code...
            // }
            // dd(Carbon::now()->format('d M Y'));
            // $tes = $join2->stok;
            // dd($tagihanTotal[0],$tagihanTotal[1]);
            // dd($join2);
            return Datatables::of($join2)->make(true);
        
    }

}
