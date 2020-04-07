@extends('layouts.master')

@section('dashboard')
   Beranda
   <small>Manajemen Rental</small>
@endsection

@section('breadcrumb')
    <li class="active"><a href="{{ url('home') }}"><i class="fa fa-dashboard"></i>Manajemen Rental</a></li>
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
        <div class="small-box bg-green">
            <div class="inner">
                <h3>{{ \App\Product::where('user_id', Auth::id())->where('manajemen', 'rental')->count() }}</h3>

                <p>Barang</p>
            </div>
            <div class="icon">
                <i class="fa fa-database"></i>
            </div>
            <a href="{{ route('rentalbarang.index') }}" class="small-box-footer">Info lengkap <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-orange">
            <div class="inner">
                <h3>{{ \App\Stockrentin::where('user_id', Auth::id())->count() }}</h3>

                <p>Stok Masuk</p>
            </div>
            <div class="icon">
                <i class="fa fa-download"></i>
            </div>
            <a href="{{ route('rentalstokmasuk.index') }}" class="small-box-footer">Info lengkap <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-purple">
            <div class="inner">
                <h3>{{ \App\Stockrentout::where('user_id', Auth::id())->count() }}</h3>

                <p>Stok Keluar</p>
            </div>
            <div class="icon">
                <i class="fa fa-upload"></i>
            </div>
            <a href="{{ route('rentalstokkeluar.index') }}" class="small-box-footer">Info lengkap <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
   
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-maroon">
            <div class="inner">
                <h3>{{ \App\Renter::where('user_id', Auth::id())->count() }}</h3>

                <p>Penyewa</p>
            </div>
            <div class="icon">
                <i class="fa fa-street-view"></i>
            </div>
            <a href="{{ route('penyewa.index') }}" class="small-box-footer">Info lengkap <i class="fa fa-arrow-circle-right"></i></a>
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
        <div class="col-lg-6">
            <div class="box box-default">
                
                    <div class="box-body">
                    {!! $chart6 ->html() !!}
                        <table id="stcokrentins" class="table table-bordered text-center">
                            <thead>
                            <tr>
                            <!-- <th>No</th> -->
                                <th>Nama Barang</th>
                                <th>Frekuensi Stok Masuk</th>
                            </tr>
                            </thead>
                            @foreach($stockrentins as $sri)
                                <tbody>
                                    <td>{{ $sri->product->nama }}</td>
                                    <td>{{ $sri->total }}</td>
                                </tbody>
                            @endforeach
                        </table>
                      
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
            <div class="box box-default">
                
                    <div class="box-body">
                    {!! $chart7 ->html() !!}
                        <table id="stockrentouts" class="table table-bordered  text-center">
                            <thead>
                            <tr>
                            <!-- <th>No</th> -->
                                <th>Nama Barang</th>
                                <th>Frekuensi Stok Keluar</th>
                            </tr>
                            </thead>
                            @foreach($stockrentouts as $sro)
                                <tbody>
                                    <td>{{ $sro->product->nama }}</td>
                                    <td>{{ $sro->total }}</td>
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
{!! $chart6->script() !!}
{!! $chart7->script() !!}
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
