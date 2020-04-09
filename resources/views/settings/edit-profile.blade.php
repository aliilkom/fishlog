@extends('layouts.master')

@section('dashboard')
    Ubah Profil
@endsection

@section('breadcrumb')
    <li><a href="{{ url('berandagudang') }}"><i class="fa fa-dashboard"></i>Beranda</a></li>
    <li><a href="{{ url('/settings/profile/') }}"><i class="fa fa-user"></i>Profil</a></li>
    <li class="active"><a href="{{ url('/settings/profile/edit') }}"><i class="fa fa-edit"></i>Ubah Profil</a></li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <!-- <div class="box-header with-border">
                    <h3 class="box-title">Ubah Profil</h3>
                </div> -->
                <!-- /.box-header -->
                <!-- form start -->
                {!! Form::model(auth()->user(), ['url' => url('/settings/profile'), 'method' => 'post', 'files' => 'true']) !!}
                <div class="box-body">
                    <div class="form-group has-feedback{{ $errors->has('name') ? ' has-error' : '' }}">
                        {!! Form::label('name', 'Nama') !!}

                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nama']) !!}
                        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                    </div>

                    <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
                        {!! Form::label('email', 'Email') !!}

                        {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
                        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                    </div>

                    <div class="form-group has-feedback{{ $errors->has('alamat') ? ' has-error' : '' }}">
                        {!! Form::label('alamat', 'Alamat') !!}

                        {!! Form::text('alamat', null, ['class' => 'form-control', 'placeholder' => 'Alamat']) !!}
                        {!! $errors->first('alamat', '<p class="help-block">:message</p>') !!}
                    </div>

                    <div class="form-group has-feedback{{ $errors->has('hp') ? ' has-error' : '' }}">
                        {!! Form::label('hp', 'Nomor HP') !!}

                        {!! Form::text('hp', null, ['class' => 'form-control', 'placeholder' => 'Nomor HP']) !!}
                        {!! $errors->first('hp', '<p class="help-block">:message</p>') !!}
                    </div>

                    <div class="form-group has-feedback{{ $errors->has('image') ? ' has-error' : '' }}">
                        {!! Form::label('image', 'Foto Profil') !!}

                        {!! Form::file('image', ['class' => 'form-control']) !!}
                        <!-- <p class="help-block">Pilih foto profil</p> -->
                        {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <!-- /.box-body -->
                
                <div class="box-footer">
                    <a href="/settings/profile" type="button" class="btn btn-default">Batal</a>
                    {!! Form::submit('Simpan', ['class' => 'btn btn-primary']) !!}
                </div>
                <!-- /.box-footer -->
                {!! Form::close() !!}
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
@endsection
