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
                    @include('errors.errors')
                    <form class="omb_loginForm" action="{{url(route('postRegister'))}}" autocomplete="off"
                          method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="input-group register-fields">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" class="form-control" required="required" name="username"
                                   value="{{ old('username') }}" placeholder="Username">
                        </div>
                        <div class="input-group register-fields">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="email" class="form-control" required="required" name="email"
                                   value="{{ old('email') }}" placeholder="Email Address">
                        </div>
                        <div class="input-group register-fields">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" class="form-control" required="required" name="firstname"
                                   value="{{ old('firstname') }}" placeholder="First Name">
                        </div>
                        <div class="input-group register-fields">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" class="form-control" required="required" name="lastname"
                                   value="{{ old('lastname') }}" placeholder="Last Name">
                        </div>
                        <div class="input-group register-fields">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <input type="password" class="form-control" required="required" name="password"
                                   value="{{ old('password') }}" placeholder="Password">
                        </div>
                        <div class="input-group register-fields">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <input type="password" class="form-control" required="required"
                                   value="{{ old('password_confirmation') }}" name="password_confirmation"
                                   placeholder="Confirm Password">
                        </div>
                        <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection