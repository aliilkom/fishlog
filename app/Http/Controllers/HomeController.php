<?php

namespace App\Http\Controllers;

use Charts;
use App\Warehouse;
use App\Category;
use App\Merk;
use App\Product;
use App\User;
use App\Stockrentin;
use App\Stockrentout;
use App\Product_Masuk;
use App\Product_Keluar;
use App\Supplier;
use App\Customer;
use App\Charts\UserChart;
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
    public function berandagudang()
    {
       
        
        $id = Auth::id();
        $products = Product::where('user_id', $id)
        ->where('manajemen', 'gudang')
        ->orderBy('jumlah','DSC')
        ->take(5)
        ->get();

        $productins = Product_Masuk::where('user_id', $id)
        ->selectRaw('count(*) as total, product_id')
        ->groupBy('product_id')
        ->orderBy('total','DSC')
        ->take(5)
        ->get();

        $productouts = Product_Keluar::where('user_id', $id)
        ->selectRaw('count(*) as total, product_id')
        ->groupBy('product_id')
        ->orderBy('total','DSC')
        ->take(5)
        ->get();

        $suppliers = Product_Masuk::where('user_id', $id)
        ->selectRaw('count(*) as total, supplier_id')
        ->groupBy('supplier_id')
        ->orderBy('total','DSC')
        ->take(5)
        ->get();

        $customers = Product_Keluar::where('user_id', $id)
        ->selectRaw('count(*) as total, customer_id')
        ->groupBy('customer_id')
        ->orderBy('total','DSC')
        ->take(5)
        ->get();
       
        $chart1 = Charts::create('bar', 'highcharts')
        ->title("5 Stok Barang Terbanyak")
        ->elementLabel("Jumlah Stok")
        ->labels($products->pluck('nama')->toArray())
        ->values($products->pluck('jumlah')->toArray())
        ->colors(['#00ff00',  '#0000ff', '#ffff00', '#ff7f00','#ff0000'])
        ->legend(false)
        ->responsive(true);

        $chart2 = Charts::create('bar', 'highcharts')
        ->title("5 Barang Pemasukan Terbanyak")
        ->elementLabel("Jumlah Stok")
        ->labels($productins->pluck('product')->pluck('nama')->toArray())
        ->values($productins->pluck('total')->toArray())
        ->colors(['#00ff00',  '#0000ff', '#ffff00', '#ff7f00','#ff0000'])
        ->legend(false)
        ->responsive(true);

        $chart3 = Charts::create('bar', 'highcharts')
        ->title("5 Barang Penjualan Terbanyak")
        ->elementLabel("Jumlah Stok")
        ->labels($productouts->pluck('product')->pluck('nama')->toArray())
        ->values($productouts->pluck('total')->toArray())
        ->colors(['#00ff00',  '#0000ff', '#ffff00', '#ff7f00','#ff0000'])
        ->legend(false)
        ->responsive(true);

        $chart4 = Charts::create('bar', 'highcharts')
        ->title("5 Penyuplai Terbanyak")
        ->elementLabel("Frekuensi Suplai")
        ->labels($suppliers->pluck('supplier')->pluck('nama')->toArray())
        ->values($suppliers->pluck('total')->toArray())
        ->colors(['#00ff00',  '#0000ff', '#ffff00', '#ff7f00','#ff0000'])
        ->legend(false)
        ->responsive(true);

        $chart5 = Charts::create('bar', 'highcharts')
        ->title("5 Pembeli Terbanyak")
        ->elementLabel("Frekuensi Beli")
        ->labels($customers->pluck('customer')->pluck('nama')->toArray())
        ->values($customers->pluck('total')->toArray())
        ->colors(['#00ff00',  '#0000ff', '#ffff00', '#ff7f00','#ff0000'])
        ->legend(false)
        ->responsive(true);

        return view('berandagudang', compact('products', 'productins', 'productouts', 'suppliers', 'customers', 'chart1', 'chart2', 'chart3', 'chart4', 'chart5'));
    }
    public function berandarental()
    {
        $id = Auth::id();
        $stockrentins = Stockrentin::where('user_id', $id)
        ->selectRaw('count(*) as total, product_id')
        ->groupBy('product_id')
        ->orderBy('total','DSC')
        ->take(5)
        ->get();

        $stockrentouts = Stockrentout::where('user_id', $id)
        ->selectRaw('count(*) as total, product_id')
        ->groupBy('product_id')
        ->orderBy('total','DSC')
        ->take(5)
        ->get();
       
        $chart6 = Charts::create('bar', 'highcharts')
        ->title("5 Stok Masuk Terbanyak")
        ->elementLabel("Jumlah Stok")
        ->labels($stockrentins->pluck('product')->pluck('nama')->toArray())
        ->values($stockrentins->pluck('total')->toArray())
        ->colors(['#00ff00',  '#0000ff', '#ffff00', '#ff7f00','#ff0000'])
        ->legend(false)
        ->responsive(true);

        $chart7 = Charts::create('bar', 'highcharts')
        ->title("5 Stok Keluar Terbanyak")
        ->elementLabel("Jumlah Stok")
        ->labels($stockrentouts->pluck('product')->pluck('nama')->toArray())
        ->values($stockrentouts->pluck('total')->toArray())
        ->colors(['#00ff00',  '#0000ff', '#ffff00', '#ff7f00','#ff0000'])
        ->legend(false)
        ->responsive(true);

        return view('berandarental', compact('stockrentins','stockrentouts','chart6', 'chart7'));
    }

}
