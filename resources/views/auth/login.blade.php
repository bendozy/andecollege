@extends('layouts.app')

@section('title')
    Login
@endsection

@section('content')
    <link href="{!! asset('css/auth.css') !!}" rel="stylesheet">
    <div class="container">
        <div class="omb_login">
            <h3 class="omb_authTitle">Login or <a href="{{url(route('getRegister'))}}">Sign up</a></h3>
            <div class="row omb_row-sm-offset-3 omb_socialButtons  ">
                <div class="col-xs-4 col-sm-2">
                    <a href="{{url(route('getSocial', ['provider' => 'facebook']))}}" class="btn btn-lg btn-block omb_btn-facebook">
                        <i class="fa fa-facebook visible-xs"></i>
                        <span class="hidden-xs">Facebook</span>
                    </a>
                </div>
                <div class="col-xs-4 col-sm-2">
                    <a href="{{url(route('getSocial', ['provider' => 'twitter']))}}" class="btn btn-lg btn-block omb_btn-twitter">
                        <i class="fa fa-twitter visible-xs"></i>
                        <span class="hidden-xs">Twitter</span>
                    </a>
                </div>
                <div class="col-xs-4 col-sm-2">
                    <a href="{{url(route('getSocial', ['provider' => 'github']))}}" class="btn btn-lg btn-block omb_btn-github">
                        <i class="fa fa-github visible-xs"></i>
                        <span class="hidden-xs">Github</span>
                    </a>
                </div>
            </div>

            <div class="row omb_row-sm-offset-3 omb_loginOr">
                <div class="col-xs-12 col-sm-6">
                    <hr class="omb_hrOr">
                    <span class="omb_spanOr">or</span>
                </div>
            </div>

            <div class="row omb_row-sm-offset-3">
                <div class="col-xs-12 col-sm-6">
                    @include('errors.errors')
                    <form class="omb_loginForm" action="{{url(route('postLogin'))}}" autocomplete="off" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" class="form-control" required="required" name="email" placeholder="Email or Username">
                        </div>
                        <span class="help-block"></span>

                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <input type="password" class="form-control" required="required" name="password" placeholder="Password">
                        </div>

                        <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
                    </form>
                </div>
            </div>
            <div class="row omb_row-sm-offset-3">
                <div class="col-xs-12 col-sm-3">
                    <label class="checkbox">
                        <input type="checkbox" value="remember">Remember Me
                    </label>
                </div>
                <div class="col-xs-12 col-sm-3">
                    <p class="omb_forgotPwd">
                        <a href="#">Forgot password?</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

@endsection