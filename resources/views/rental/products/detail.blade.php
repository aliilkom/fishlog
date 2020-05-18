@extends('layouts.master')

@section('dashboard')
    Detail Barang
    <small>Manajemen Rental</small>
@endsection
@section('breadcrumb')
    <li><a href="{{ url('berandarental') }}"><i class="fa fa-dashboard"></i>Manajemen Rental</a></li>
    <li><a href="{{ url('rentalbarang') }}"><i class="fa fa-cubes"></i>Barang</a></li>
    <li class="active"><a href="#"><i class="fa fa-thumb-tack"></i>Detail</a></li>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-3">

        <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="{{$product->image}}">

              <h3 class="profile-username text-center">{{ $product->nama }}</h3>
              

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Stok Masuk</b> <a class="pull-right">{{ $productin->count() }}</a>
                </li>
                <li class="list-group-item">
                  <b>Stok Keluar</b> <a class="pull-right">{{ $productout->count() }}</a>
                </li>
              </ul>

              
              <a href="{{ url('/barang') }}" class="btn btn-danger btn-block">Kembali</a>
            </div>
            <!-- /.box-body -->
          </div>
          </div>
          <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Informasi Barang</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-striped">
                        <tr>
                            <td class="text-muted"><b>Lokasi Gudang</b></td>
                            <td>{{ $product->warehouse->nama }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted"><b>SKU</b></td>
                            <td>{{ $product->sku }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted"><b>Stok Tersedia</b></td>
                            <td>{{ $product->jumlah }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted"><b>Satuan</b></td>
                            <td>{{ $product->satuan }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted"><b>Kategori</b></td>
                            <td>{{ $product->category->name }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted"><b>Merek</b></td>
                            <td>{{ $product->merk->name }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted"><b>Spesifikasi</b></td>
                            <td>{{ $product->spesifikasi }}</td>
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
            <h3 class="box-title">Stok Masuk pada {{$product->nama}}</h3>
        </div>

        <!-- /.box-header -->
        <div class="box-body">
            <table id="productin" class="table table-bordered">
                <thead>
                <tr>
                <!-- <th>No</th> -->
                    <th>Tanggal Masuk</th>
                    <th>Stok Masuk</th>
                    <th>Penyewa</th>
                    <th>Pembayaran</th>
                </tr>
                </thead>
                @foreach($productin as $pi)
                    <tbody>
                        <td>{{ $pi->tanggal }}</td>
                        <td>{{ $pi->jumlah }}</td>
                        <td>{{ $pi->renter->nama }}</td>
                        <td>{{ $pi->pembayaran }}</td>
                        
                    </tbody>
                @endforeach

                
            </table>
        </div>
        <!-- /.box-body -->
    </div>
     <!-- DataTables -->
     <div class="box col-md-6">

        <div class="box-header">
            <h3 class="box-title">Stok Keluar pada {{$product->nama}}</h3>
        </div>

        <!-- /.box-header -->
        <div class="box-body">
            <table id="productout" class="table table-bordered">
            <thead>
                <tr>
                <!-- <th>No</th> -->
                    <th>Tanggal Keluar</th>
                    <th>Stok Keluar</th>
                    <th>Penyewa</th>
                    <th>Pembayaran</th>
                </tr>
                </thead>
                @foreach($productout as $po)
                    <tbody>
                        <td>{{ $po->tanggal }}</td>
                        <td>{{ $po->jumlah }}</td>
                        <td>{{ $po->renter->nama }}</td>
                        <td>{{ $po->pembayaran }}</td>
                        
                    </tbody>
                @endforeach

                
            </table>
        </div>
        <!-- /.box-body -->
    </div>
     <!-- DataTables -->
     
@endsection
