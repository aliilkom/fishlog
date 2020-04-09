@extends('layouts.master')

@section('dashboard')
    Detail Gudang
    <small>Manajemen Gudang</small>
@endsection
@section('breadcrumb')
    <li><a href="{{ url('berandagudang') }}"><i class="fa fa-dashboard"></i> Beranda</a></li>
    <li><a href="{{ url('gudang') }}"><i class="fa fa-truck"></i> Gudang</a></li>
    <li class="active"><i class="fa fa-thumb-tack"></i> Detail</li>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-3">

        <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="{{$warehouse->image}}" alt="User profile picture">

              <h3 class="profile-username text-center">{{ $warehouse->nama }}</h3>
              
              <!-- <p class="text-muted text-center text-capitalize">{{ $warehouse->user->name }}</p> -->

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Jumlah Barang</b> <a class="pull-right">{{ $product->count() }}</a>
                </li>
                <li class="list-group-item">
                  <b>Jumlah Barang Rental</b> <a class="pull-right">{{ $rentproduct->count() }}</a>
                </li>
                <li class="list-group-item">
                  <b>Total Barang</b> <a class="pull-right">{{ $product->count()+$rentproduct->count() }}</a>
                </li>
              </ul>

              
              <a href="{{ url('/gudang') }}" class="btn btn-danger btn-block">Kembali</a>
            </div>
            <!-- /.box-body -->
          </div>
          </div>
          <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Informasi Gudang</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-striped">
                        <tr>
                            <td class="text-muted"><b>Nama Pemilik</b></td>
                            <td>{{ $warehouse->user->name }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted"><b>Telepon</b></td>
                            <td>{{ $warehouse->hp }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted"><b>Lokasi</b></td>
                            <td>{{ $warehouse->lokasi }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted"><b>Jumlah Ruang</b></td>
                            <td>{{ $warehouse->ruang }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted"><b>Kapasitas</b></td>
                            <td>{{ $warehouse->kapasitas }}</td>
                        </tr>
                        <!-- <tr>
                            <td class="text-muted">Login Terakhir</td>
                            <td>{{ auth()->user()->last_login }}</td>
                        </tr> -->
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
            <h3 class="box-title">Barang di {{$warehouse->nama}}</h3>
        </div>

        <!-- /.box-header -->
        <div class="box-body">
            <table id="product" class="table table-bordered">
                <thead>
                <tr>
                <!-- <th>No</th> -->
                    <th>Nama Barang</th>
                    <th>SKU</th>
                    <th>Stok</th>
                    <th>Satuan</th>
                    <th>Kategori</th>
                    <th>Merek</th>
                    <th>Spesifikasi</th>
                </tr>
                </thead>
                @foreach($product as $p)
                    <tbody>
                        <td>{{ $p->nama }}</td>
                        <td>{{ $p->sku }}</td>
                        <td>{{ $p->jumlah }}</td>
                        <td>{{ $p->satuan }}</td>
                        <td>{{ $p->category->name }}</td>
                        <td>{{ $p->merk->name }}</td>
                        <td>{{ $p->spesifikasi }}</td>
                        
                    </tbody>
                @endforeach

                
            </table>
        </div>
        <!-- /.box-body -->
    </div>
     <!-- DataTables -->
     <div class="box col-md-6">

        <div class="box-header">
            <h3 class="box-title">Barang Rental di {{$warehouse->nama}}</h3>
        </div>

        <!-- /.box-header -->
        <div class="box-body">
            <table id="product" class="table table-bordered">
                <thead>
                <tr>
                <!-- <th>No</th> -->
                    <th>Nama Barang</th>
                    <th>SKU</th>
                    <th>Stok</th>
                    <th>Satuan</th>
                    <th>Kategori</th>
                    <th>Merek</th>
                    <th>Spesifikasi</th>
                </tr>
                </thead>
                @foreach($rentproduct as $p)
                    <tbody>
                        <td>{{ $p->nama }}</td>
                        <td>{{ $p->sku }}</td>
                        <td>{{ $p->jumlah }}</td>
                        <td>{{ $p->satuan }}</td>
                        <td>{{ $p->category->name }}</td>
                        <td>{{ $p->merk->name }}</td>
                        <td>{{ $p->spesifikasi }}</td>
                        
                    </tbody>
                @endforeach

                
            </table>
        </div>
        <!-- /.box-body -->
    </div>
     <!-- DataTables -->
     
@endsection
