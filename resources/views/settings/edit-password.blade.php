@extends('layouts.master')

@section('dashboard')
    Ubah Password
@endsection

@section('breadcrumb')
<li><a href="{{ url('berandagudang') }}"><i class="fa fa-dashboard"></i>Manajemen Gudang</a></li>
    <li><a href="{{ url('/settings/profile/') }}"><i class="fa fa-user"></i>Profil</a></li>
    <li class="active"><a href="{{ url('/settings/password') }}"><i class="fa fa-edit"></i>Ubah Password</a></li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <!-- <div class="box-header with-border">
                    <h3 class="box-title">Ubah Password</h3>
                </div> -->
                <!-- /.box-header -->
                {!! Form::open(['url' => url('/settings/password'), 'method' => 'post']) !!}
                    <div class="box-body">

                        <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                            {!! Form::label('password', 'Password Lama') !!}

                            {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password lama']) !!}
                            {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
                        </div>

                        <div class="form-group has-feedback{{ $errors->has('new_password') ? ' has-error' : '' }}">
                            {!! Form::label('new_password', 'Password Baru') !!}

                            {!! Form::password('new_password', ['class' => 'form-control', 'placeholder' => 'Password baru']) !!}
                            {!! $errors->first('new_password', '<p class="help-block">:message</p>') !!}
                        </div>

                        <div class="form-group has-feedback{{ $errors->has('new_password_confirmation') ? ' has-error' : '' }}">
                            {!! Form::label('new_password_confirmation', 'Konfirmasi Password Baru') !!}

                            {!! Form::password('new_password_confirmation', ['class' => 'form-control', 'placeholder' => 'Konfirmasi password baru']) !!}
                            {!! $errors->first('new_password_confirmation', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <a href="/settings/profile" type="button" class="btn btn-default">Batal</a>
                        {!! Form::submit('Simpan', ['class' => 'btn btn-primary']) !!}
                    </div>
                {!! Form::close() !!}
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
@endsection
