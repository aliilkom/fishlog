
@extends('layouts.master')

@section('content')

    <div class="row">

        <div class="col-md-3">
            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <!-- <img class="profile-user-img img-responsive img-circle" src="#" alt="User profile picture"> -->

                    <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>

                    <p class="text-muted text-center"></p>

                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                        <b>Nomor HP</b> <a class="pull-right">{{ Auth::user()->hp }}</a>
                        </li>
                    </ul>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
            
        </div>
        <!-- /.col-md-3 -->
        

        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#settings" data-toggle="tab">Pengaturan</a></li>
                </ul>
                <div class="tab-content">
                   
                    <div class="active tab-pane" id="settings">
                        <form class="form-horizontal" role="form" method="POST" action="#">
                            {!! csrf_field() !!}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="inputName" class="col-sm-2 control-label">Nama</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputName" placeholder="Name" value="{{ old('name', Auth::user()->name) }}" name="name">

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="inputEmail" placeholder="Email" value="{{ old('email', Auth::user()->email) }}" name="email">
                                </div>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('no_hp') ? ' has-error' : '' }}">
                                <label for="inputName" class="col-sm-2 control-label">Nomor HP</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputNoHP" placeholder="Nomor HP" value="{{ old('no_hp', Auth::user()->no_hp) }}" name="no_hp">

                                    @if ($errors->has('no_hp'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('no_hp') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('alamat') ? ' has-error' : '' }}">
                                <label for="inputAlamat" class="col-sm-2 control-label">Alamat</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputAlamat" placeholder="Alamat" value="{{ old('alamat', Auth::user()->alamat) }}" name="alamat">

                                    @if ($errors->has('alamat'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('alamat') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="inputPassword" class="col-sm-2 control-label">Password</label>

                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="inputPassword" placeholder="Password" name="password">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label for="inputConfirmPassword" class="col-sm-2 control-label">Konfirmasi Password</label>

                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="inputConfirmPassword" placeholder="Konfirmasi Password" name="password_confirmation">

                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
                
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->

    </div>
    <!-- /.row -->
@endsection
