@extends('layouts.master')

@section('dashboard')
   Beranda
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
                <h3>{{ \App\Product::count() }}</h3>

                <p>Rental</p>
            </div>
            <div class="icon">
                <i class="fa fa-puzzle-piece"></i>
            </div>
            <a href="{{ route('rental.index') }}" class="small-box-footer">Info lengkap <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-orange">
            <div class="inner">
                <h3>{{ \App\Product_Masuk::count() }}</h3>

                <p>Stok Masuk</p>
            </div>
            <div class="icon">
                <i class="fa fa-download"></i>
            </div>
            <a href="{{ route('stokrentalmasuk.index') }}" class="small-box-footer">Info lengkap <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-purple">
            <div class="inner">
                <h3>{{ \App\Product_Keluar::count()  }}</h3>

                <p>Stok Keluar</p>
            </div>
            <div class="icon">
                <i class="fa fa-upload"></i>
            </div>
            <a href="{{ route('stokrentalkeluar.index') }}" class="small-box-footer">Info lengkap <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
   
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-maroon">
            <div class="inner">
                <h3>{{ \App\Renter::count() }}</h3>

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
