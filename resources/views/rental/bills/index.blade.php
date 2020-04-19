@extends('layouts.master')

@section('dashboard')
   Tagihan
   <small>Manajemen Rental</small>
@endsection

@section('breadcrumb')
    <li><a href="{{ url('berandarental') }}"><i class="fa fa-dashboard"></i>Manajemen Rental</a></li>
    
    <li class="active"><a href="{{ url('tagihan') }}"><i class="fa fa-money"></i>Tagihan</a></li>
@endsection

@section('top')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    {{--<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">--}}
    @include('sweet::alert')
@endsection

@section('content')
    

    <div class="box col-md-6">

        <div class="box-header">
            <h3 class="box-title">Daftar Tagihan</h3>
        </div>

        <!-- /.box-header -->
        <div class="box-body">
            <table id="bill" class="table table-bordered">
                <thead>
                <tr>
                <!-- <th>No</th> -->
                    <th>Penyuplai</th>
                    <th>Nama Barang</th>
                    <th>Stok Barang</th>
                    <th>Tagihan</th>
                    <th>Keterangan</th>
                    <!-- <th>Cetak Tagihan</th> -->
                </tr>
                </thead>
                @foreach($join2 as $j)
                    <tbody>
                        <td>{{ $j->nama }}</td>
                        <td>{{ $j->barang }}</td>
                        <td>{{ $j->stok }}</td>
                        <td>{{ $j->tagihan }}</td>
                        <td>{{ $j->tr_ket }}</td>
                    </tbody>
                @endforeach
            </table>
        </div>
        <!-- /.box-body -->
    </div>

    {{--@include('renters.form_import')--}}

    @include('rental.renters.form')

@endsection

@section('bot')

@endsection
