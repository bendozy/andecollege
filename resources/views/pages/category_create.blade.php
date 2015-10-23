@extends('layouts.app')

@section('title')
    All Resources
@endsection

@section('content')
    <link href="{!! asset('css/auth.css') !!}" rel="stylesheet">
    <div class="container">
        <div class="row">
            <div class="col col-sm-3">
                @include('includes.category')
            </div>
            <div class="col col-sm-9">
                <div class="container">
                    <div class="omb_login">
                        <div class="col-xs-12 col-sm-6">
                            <h3 class="omb_authTitle">Create Category</h3>
                            @include('errors.errors')
                            <form class="omb_loginForm" action="{{url(route('category.store'))}}" autocomplete="off"
                                  method="POST">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-group"></i></span>
                                    <input type="text" class="form-control" required="required" name="name"
                                           placeholder="Category Name">
                                </div>
                                <button class="btn btn-lg btn-primary btn-block" type="submit">Create Category</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection