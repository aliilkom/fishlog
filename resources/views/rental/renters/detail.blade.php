@extends('layouts.master')

@section('dashboard')
    Detail Penyewa
    <small>Manajemen Rental</small>
@endsection
@section('breadcrumb')
    <li><a href="{{ url('berandarental') }}"><i class="fa fa-dashboard"></i>Manajemen Gudang</a></li>
    <li><a href="{{ url('penyewa') }}"><i class="fa fa-street-view"></i>Penyewa</a></li>
    <li class="active"><a href="#"><i class="fa fa-thumb-tack"></i>Detail</a></li>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-3">

        <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-square" src="{{$renter->image}}" alt="User profile picture">

              <h3 class="profile-username text-center">{{ $renter->nama }}</h3>
              

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Transaksi Stok Masuk</b> <a class="pull-right">{{ $productin->count() }}</a>
                </li>
                <li class="list-group-item">
                  <b>Transaksi Stok Keluar</b> <a class="pull-right">{{ $productout->count() }}</a>
                </li>
                <li class="list-group-item">
                  <b>Total Transaksi</b> <a class="pull-right">{{ $transaksi->count() }}</a>
                </li>
              </ul>

              
              <a href="{{ url('/penyewa') }}" class="btn btn-danger btn-block">Kembali</a>
            </div>
            <!-- /.box-body -->
          </div>
          </div>
          <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Informasi Pembeli</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-striped">
                        <tr>
                            <td class="text-muted"><b>Perusahaan</b></td>
                            <td>{{ $renter->perusahaan }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted"><b>Telepon</b></td>
                            <td>{{ $renter->telepon }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted"><b>Alamat</b></td>
                            <td>{{ $renter->alamat }}</td>
                        </tr>
                        
                        <tr>
                            <td class="text-muted"><b>Foto Identitas</b></td>
                            <td><img src="{{ $renter->image }}" class="img-square img-thumbnail img-responsive" style="width:50%"></td>
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
            <h3 class="box-title">Riwayat Transaksi oleh {{$renter->nama}}</h3>
        </div>

        <!-- /.box-header -->
        <div class="box-body">
            <table id="productout" class="table table-bordered">
                <thead>
                <tr>
                <!-- <th>No</th> -->
                    <th>Tanggal</th>
                    <th>Riwayat Transaksi</th>
                    <th>Jumlah</th>
                </tr>
                </thead>
                @foreach($transaksi as $tr)
                    <tbody>
                        <td>{{ $tr->tanggal }}</td>
                        <td>{{ $tr->keterangan }}</td>
                        <td>{{ $tr->jumlah }}</td>
                        
                    </tbody>
                @endforeach

                
            </table>
        </div>
        <!-- /.box-body -->
    </div>
     <!-- DataTables -->
     
     
@endsection
