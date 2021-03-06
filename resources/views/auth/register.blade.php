@extends('layouts.app')

@section('content')
<div class="container panel-body ">
    <div class="row">
        <div class="col-md-4"><br></br>
        &nbsp &nbsp &nbsp &nbsp &nbsp
        <div class="verticalhorizontal"><img src="/img/logo.png"></div>
             &nbsp
        </div> 
        <div class="col-md-8">
        &nbsp&nbsp&nbsp
                <div class="container panel-body ">
                <b class=text-center>
                <div>Transformasi Digital Gudang Cold Storage.</div>&nbsp
                <div>Daftarkan Gudang anda di ekosistem</div>
                <div>Gudang FishLog !</div>
                </b>
                &nbsp
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

                            <div class="col-md-6 mx-auto">
                                <input id="name" placeholder="Nama Pengguna" type="text" class="form-control text-center" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                            <div class="col-md-6 mx-auto">
                                <input id="email" placeholder="Email" type="email" class="form-control text-center" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('hp') ? ' has-error' : '' }}">

                            <div class="col-md-6 mx-auto">
                                <input id="hp" placeholder="Telepon" type="hp" class="form-control text-center" name="hp" value="{{ old('hp') }}">

                                @if ($errors->has('hp'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('hp') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('alamat') ? ' has-error' : '' }}">

                            <div class="col-md-6 mx-auto">
                                <input id="alamat" placeholder="Alamat" type="alamat" class="form-control text-center" name="alamat" value="{{ old('alamat') }}">

                                @if ($errors->has('alamat'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('alamat') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            
                            <div class="col-md-6 mx-auto">
                                <input id="password" placeholder="Password" type="password" class="form-control text-center" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            
                            <div class="col-md-6 mx-auto">
                                <input id="password-confirm" placeholder="Konfirmasi Password" type="password" class="form-control text-center" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <input id="is_admin" type="hidden" class="form-control" name="is_admin" value="1">
                        </div>

                        <div class="form-group">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">
                                    Daftar
                                </button>
                                
                            </div>
                        </div>
                        <b>
                            <div class="text-center">
                                Sudah memiliki akun?
                                <a href="{{ route('login') }}">
                                    Masuk
                                </a>
                            </div>
                        </b>
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>
    </div>
<style>
.verticalhorizontal {
    display: table-cell;
    height: 400px;
    text-align: right;
    width: 500px;
    vertical-align: middle;
}

</style>
@endsection
