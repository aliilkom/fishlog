@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12"><br></br><br></br><br></br>
            <div class="panel panel-default">
                <div class="panel-heading text-center"><img src="/img/logo.png"></div>
                &nbsp
                <!-- <h6 class="text-center">
                Bersama-sama membangun ekosistem dan integrasi jaringan gudang beku terbesar di Indonesia
                </h6> -->
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            

                            <div class="col-md-6 mx-auto">
                                <input id="email" placeholder="Email" type="email" class="form-control text-center" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
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

                        <!-- <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div> -->

                        <div class="form-group">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">
                                    Masuk
                                </button>
                                
                                <!-- <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a> -->
                            </div>
                        </div>
                        <div class="text-center">
                                Belum memiliki akun?
                                <a href="{{ route('register') }}">
                                    Daftar
                                </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
