@extends('layouts.master')

@section('dashboard')
   Beranda
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
                <h3>{{ \App\Product::where('user_id', Auth::id())->count() }}</h3>
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
                <h3>{{ \App\Category::where('user_id', Auth::id())->count() }}<sup style="font-size: 20px"></sup></h3>

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
                <h3>{{ \App\Merk::where('user_id', Auth::id())->count() }}</h3>

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

    <div class="row">
        <div class="box">
            <div class="box-body">
            <div class="callout callout-success">
                <h4>Success</h4>

                <p>{{ session('status') }} You are logged in!</p>
            </div>
            </div>
        </div>
    </div>
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
