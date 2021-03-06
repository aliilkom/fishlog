@extends('layouts.master')

@section('dashboard')
    Profil
@endsection

@section('breadcrumb')
    <li><a href="{{ url('berandagudang') }}"><i class="fa fa-dashboard"></i>Manajemen Gudang</a></li>
    <li class="active"><a href="{{ url('settings/profile') }}"><i class="fa fa-user"></i>Profil</a></li>
@endsection

@section('content')
@if ($message = Session::get('profile-success'))
      <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button> 
          <strong>{{ $message }}</strong>
      </div>
@endif
@if ($message = Session::get('password-success'))
      <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button> 
          <strong>{{ $message }}</strong>
      </div>
@endif

    <div class="row">
        <div class="col-md-3">

        <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="{{ asset('/img/'. auth()->user()->image) }}">

              <h3 class="profile-username text-center">{{ auth()->user()->name }}</h3>

              <p class="text-muted text-center text-capitalize">{{ auth()->user()->role }}</p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Gabung Sejak</b> <a class="pull-right">{{ auth()->user()->created_at->format('d/m/Y') }}</a>
                </li>
              </ul>

              <a href="{{ url('/settings/profile/edit') }}" class="btn btn-primary btn-block">Ubah Profil</a>
              <a href="{{ url('/settings/password') }}" class="btn btn-warning btn-block">Ubah Password</a>
            </div>
            <!-- /.box-body -->
          </div>
          </div>
          <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Informasi Profil</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-striped">
                        <tr>
                            <td class="text-muted"><b>Nama</b></td>
                            <td>{{ auth()->user()->name }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted"><b>Email</b></td>
                            <td>{{ auth()->user()->email }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted"><b>Alamat</b></td>
                            <td>{{ auth()->user()->alamat }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted"><b>Telepon</b></td>
                            <td>{{ auth()->user()->hp }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted"><b>Foto Profil</b></td>
                            <td><img src="{{ asset('/img/'. auth()->user()->image) }}" class="img-square img-thumbnail img-responsive" style="width:50%"></td>
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
@endsection
