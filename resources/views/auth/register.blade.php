@extends('layouts.app')

@section('title')
    Login
@endsection

@section('content')
    <link href="{!! asset('css/auth.css') !!}" rel="stylesheet">
    <div class="container">
        <div class="omb_login">
            <h3 class="omb_authTitle">Create an Account or <a href="{{url(route('getLogin'))}}">Login</a></h3>

            <div class="row omb_row-sm-offset-3">
                <div class="col-xs-12 col-sm-6">
                    <form class="omb_loginForm" action="" autocomplete="off" method="POST">
                        <div class="input-group register-fields">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" class="form-control" name="email" placeholder="Username">
                        </div>
                        <div class="input-group register-fields">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" class="form-control" name="username" placeholder="Email Address">
                        </div>
                        <div class="input-group register-fields">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" class="form-control" name="firstname" placeholder="First Name">
                        </div>
                        <div class="input-group register-fields">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" class="form-control" name="lastname" placeholder="Last Name">
                        </div>
                        <div class="input-group register-fields">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>
                        <div class="input-group register-fields">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">
                        </div>
                        <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection