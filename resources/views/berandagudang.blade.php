@extends('layouts.master')

@section('dashboard')
   Beranda
   <small>Manajemen Gudang</small>
@endsection

@section('breadcrumb')
    <li class="active"><a href="{{ url('home') }}"><i class="fa fa-dashboard"></i>Manajemen Gudang</a></li>
@endsection

@section('top')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
<!-- Small boxes (Stat box) -->
<div class="row">
    
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3>{{ \App\Warehouse::where('user_id', Auth::id())->count() }}</h3>

                <p>Gudang</p>
            </div>
            <div class="icon">
                <i class="fa fa-truck"></i>
            </div>
            <a href="{{ route('gudang.index') }}" class="small-box-footer">Info lengkap <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-blue">
            <div class="inner">
                <h3>{{ \App\Product::where('user_id', Auth::id())->where('manajemen', 'gudang')->count() }}</h3>
                <p>Barang</p>
            </div>
            <div class="icon">
                <i class="fa fa-cubes"></i>
            </div>
            <a href="{{ route('barang.index') }}" class="small-box-footer">Info lengkap <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>{{ \App\Category::where('user_id', Auth::id())->where('manajemen', 'gudang')->count() }}<sup style="font-size: 20px"></sup></h3>

                <p>Kategori</p>
            </div>
            <div class="icon">
                <i class="fa fa-tags"></i>
            </div>
            <a href="{{ route('kategori.index') }}" class="small-box-footer">Info lengkap <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3>{{ \App\Merk::where('user_id', Auth::id())->where('manajemen', 'gudang')->count() }}</h3>

                <p>Merek</p>
            </div>
            <div class="icon">
                <i class="fa fa-flag"></i>
            </div>
            <a href="{{ route('merek.index') }}" class="small-box-footer">Info lengkap <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    
    <!-- ./col -->
</div>



<div class="row">
    
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-orange">
            <div class="inner">
                <h3>{{ \App\Product_Masuk::where('user_id', Auth::id())->count() }}</h3>

                <p>Stok Masuk</p>
            </div>
            <div class="icon">
                <i class="fa fa-sign-in"></i>
            </div>
            <a href="{{ route('stokmasuk.index') }}" class="small-box-footer">Info lengkap <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>{{ \App\Supplier::where('user_id', Auth::id())->count() }}<sup style="font-size: 20px"></sup></h3>

                <p>Penyuplai</p>
            </div>
            <div class="icon">
                <i class="fa fa-user-plus"></i>
            </div>
            <a href="{{ route('penyuplai.index') }}" class="small-box-footer">Info lengkap <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-purple">
            <div class="inner">
                <h3>{{ \App\Product_Keluar::where('user_id', Auth::id())->count() }}</h3>

                <p>Stok Keluar</p>
            </div>
            <div class="icon">
                <i class="fa fa-sign-out"></i>
            </div>
            <a href="{{ route('stokkeluar.index') }}" class="small-box-footer">Info lengkap <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-maroon">
            <div class="inner">
                <h3>{{ \App\Customer::where('user_id', Auth::id())->count() }}</h3>

                <p>Pembeli</p>
            </div>
            <div class="icon">
                <i class="fa fa-user-secret"></i>
            </div>
            <a href="{{ route('pembeli.index') }}" class="small-box-footer">Info lengkap <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>
<!-- 
    <div class="row">
        <div class="box">
            <div class="box-body">
            <div class="callout callout-success">
                <h4>Success</h4>

                <p>{{ session('status') }} You are logged in!</p>
            </div>
            </div>
        </div>
    </div> -->
    <div class="row">
        <div class="col-lg-12">
            <div class="box box-default">
                
                    <div class="box-body">
                    {!! $chart1 ->html() !!}
                        <table id="products" class="table table-bordered text-center">
                            <thead>
                            <tr>
                                <th >Lokasi Gudang</th>
                                <th>Nama Barang</th>
                                <th>Jumlah</th>
                            </tr>
                            </thead>
                            @foreach($products as $p)
                                <tbody>
                                    <td>{{ $p->warehouse->nama }}</td>
                                    <td>{{ $p->nama }}</td>
                                    <td>{{ $p->jumlah }}</td>
                                </tbody>
                            @endforeach
                        </table>
                      
                    </div>
                </div>
            </div>         
            </div>
<div class="row">
        <div class="col-lg-6">
            <div class="box box-default">
                
            <div class="box-body">
                    {!! $chart2 ->html() !!}
                        <table id="productins" class="table table-bordered text-center">
                            <thead>
                            <tr>
                            <!-- <th>No</th> -->
                                <th>Nama Barang</th>
                                <th>Frekuensi Stok Masuk</th>
                            </tr>
                            </thead>
                            @foreach($productins as $pi)
                                <tbody>
                                    <td>{{ $pi->product->nama }}</td>
                                    <td>{{ $pi->total }}</td>
                                </tbody>
                            @endforeach
                        </table>
                      
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
            <div class="box box-default">
                
            <div class="box-body">
                    {!! $chart3 ->html() !!}
                        <table id="productouts" class="table table-bordered text-center">
                            <thead>
                            <tr>
                            <!-- <th>No</th> -->
                                <th>Nama Barang</th>
                                <th>Frekuensi Stok Keluar</th>
                            </tr>
                            </thead>
                            @foreach($productouts as $po)
                                <tbody>
                                    <td>{{ $po->product->nama }}</td>
                                    <td>{{ $po->total }}</td>
                                </tbody>
                            @endforeach
                        </table>
                      
                    </div>
                </div>
            
            </div>
            </div>
            <div class="row">
        <div class="col-lg-6">
            <div class="box box-default">
                
            <div class="box-body">
                    {!! $chart4 ->html() !!}
                        <table id="suppliers" class="table table-bordered text-center">
                            <thead>
                            <tr>
                            <!-- <th>No</th> -->
                                <th>Nama Penyuplai</th>
                                <th>Frekuensi Suplai</th>
                            </tr>
                            </thead>
                            @foreach($suppliers as $su)
                                <tbody>
                                    <td>{{ $su->supplier->nama }}</td>
                                    <td>{{ $su->total }}</td>
                                </tbody>
                            @endforeach
                        </table>
                      
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
            <div class="box box-default">
                
            <div class="box-body">
                    {!! $chart5 ->html() !!}
                        <table id="customers" class="table table-bordered text-center">
                            <thead>
                            <tr>
                            <!-- <th>No</th> -->
                                <th>Nama Pembeli</th>
                                <th>Frekuensi Beli</th>
                            </tr>
                            </thead>
                            @foreach($customers as $cu)
                                <tbody>
                                    <td>{{ $cu->customer->nama }}</td>
                                    <td>{{ $cu->total }}</td>
                                </tbody>
                            @endforeach
                        </table>
                      
                    </div>
                </div>
            
            </div>
            
         
            
<style>
    table tbody:nth-child(n+7) {
    display:none;
    }
</style>      

{!! Charts::scripts() !!}
{!! $chart1->script() !!}
{!! $chart2->script() !!}
{!! $chart3->script() !!}
{!! $chart4->script() !!}
{!! $chart5->script() !!}

<!-- <script>
var url = "{{url('beranda1')}}";
var barang = new Array();
var jumlah = new Array();
$(document).ready(function(){
          $.get(url, function(response){
            response.forEach(function(data){
                barang.push(data.nama);
                jumlah.push(data.jumlah);
            });
var ctx = document.getElementById("myChart").getContext('2d');
	var myChart = new Chart(ctx, {
		type: 'bar',
    
	data: {
        
		labels: barang,
		datasets: [{
			data: jumlah,
			backgroundColor: [
			'rgba(255, 99, 132, 0.2)',
			'rgba(54, 162, 235, 0.2)',
			'rgba(255, 206, 86, 0.2)',
			'rgba(75, 192, 192, 0.2)',
			'rgba(153, 102, 255, 0.2)',
			'rgba(255, 159, 64, 0.2)'
			],
			borderColor: [
			'rgba(255,99,132,1)',
			'rgba(54, 162, 235, 1)',
			'rgba(255, 206, 86, 1)',
			'rgba(75, 192, 192, 1)',
			'rgba(153, 102, 255, 1)',
			'rgba(255, 159, 64, 1)'
			],
		borderWidth: 1
		}]
	},
	options: {
        legend: {
            display: false,
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
	}
});
</script> -->
    
@endsection

@section('top')
@endsection


{{--@extends('layouts.app')--}}

{{--@section('content')--}}
{{--<div class="container">--}}
    {{--<div class="row justify-content-center">--}}
        {{--<div class="col-md-8">--}}
            {{--<div class="card">--}}
                {{--<div class="card-header">Dashboard</div>--}}

                {{--<div class="card-body">--}}
                    {{--@if (session('status'))--}}
                        {{--<div class="alert alert-success" role="alert">--}}
                            {{--{{ session('status') }}--}}
                        {{--</div>--}}
                    {{--@endif--}}

                    {{--You are logged in!--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
{{--@endsection--}}
