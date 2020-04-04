<?php

namespace App\Http\Controllers;

use App\Warehouse;
use App\Category;
use App\Merk;
use App\Product;
use App\Product_Keluar;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function beranda1()
    {
        $id = Auth::id();
        $products = Product::orderBy('jumlah','DSC')
        ->where('user_id', $id)
        ->get();

        $id = Auth::id();
        $productouts = Product_Keluar::orderBy('product_id','ASC')
        ->where('user_id', $id)
        ->selectRaw('count(*) as total, product_id')
        ->groupBy('product_id')
        ->get();
            
        return view('beranda1', compact('products','productouts'));
    }
    public function beranda2()
    {
        return view('beranda2');
    }
}
