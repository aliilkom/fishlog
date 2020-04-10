@extends('layouts.master')

@section('dashboard')
    Detail Penyuplai
    <small>Manajemen Gudang</small>
@endsection
@section('breadcrumb')
    <li><a href="{{ url('berandagudang') }}"><i class="fa fa-dashboard"></i>Manajemen Gudang</a></li>
    <li><a href="{{ url('penyuplai') }}"><i class="fa fa-user-plus"></i>Penyuplai</a></li>
    <li class="active"><a href="#"><i class="fa fa-thumb-tack"></i>Detail</a></li>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-3">

        <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-square" src="{{$supplier->image}}">

              <h3 class="profile-username text-center">{{ $supplier->nama }}</h3>
              

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Riwayat Stok Masuk</b> <a class="pull-right">{{ $productin->count() }}</a>
                </li>
              </ul>

              
              <a href="{{ url('/penyuplai') }}" class="btn btn-danger btn-block">Kembali</a>
            </div>
            <!-- /.box-body -->
          </div>
          </div>
          <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Informasi Penyuplai</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-striped">
                        <tr>
                            <td class="text-muted"><b>Perusahaan</b></td>
                            <td>{{ $supplier->perusahaan }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted"><b>Telepon</b></td>
                            <td>{{ $supplier->telepon }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted"><b>Alamat</b></td>
                            <td>{{ $supplier->alamat }}</td>
                        </tr>
                        
                        <tr>
                            <td class="text-muted"><b>Foto Identitas</b></td>
                            <td><img src="{{ $supplier->image }}" class="img-square img-thumbnail img-responsive" style="width:50%"></td>
                        </tr>
                       
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                  
                </div>
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    <div class="box col-md-6">

        <div class="box-header">
            <h3 class="box-title">Riwayat Stok Masuk oleh {{$supplier->nama}}</h3>
        </div>

        <!-- /.box-header -->
        <div class="box-body">
            <table id="productin" class="table table-bordered">
                <thead>
                <tr>
                <!-- <th>No</th> -->
                    <th>Tanggal Masuk</th>
                    <th>Stok Masuk</th>
                    <th>Pembayaran</th>
                </tr>
                </thead>
                @foreach($productin as $pi)
                    <tbody>
                        <td>{{ $pi->tanggal }}</td>
                        <td>{{ $pi->jumlah }}</td>
                        <td>{{ $pi->pembayaran }}</td>
                        
                    </tbody>
                @endforeach

                
            </table>
        </div>
        <!-- /.box-body -->
    </div>
     <!-- DataTables -->
     
     
@endsection
