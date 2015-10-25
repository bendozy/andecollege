@extends('layouts.app')

@section('title')
    Update Resource
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
                            <h3 class="omb_authTitle">Update Resource</h3>
                            @include('errors.errors')
                            <form class="omb_loginForm"
                                  action="{{url(route('resource.update',['id'=> $resource->id]))}}"
                                  autocomplete="off"
                                  method="POST">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <div class="input-group resource-fields">
                                    <span class="input-group-addon"><i class="fa fa-group"></i></span>
                                    <input type="text" class="form-control" required="required" name="title"
                                           placeholder="Resource Title" value="{{$resource->title}}">
                                </div>

                                <div class="input-group resource-fields">
                                    <span class="input-group-addon"><i class="fa fa-vimeo"></i></span>
                                    <input type="url" class="form-control" required="required" name="url"
                                           placeholder="Resource URL" value={{$resource->link}}>
                                </div>

                                <div class="input-group resource-fields">
                                    <span class="input-group-addon"><i class="fa fa-group"></i></span>
                                    <select class="form-control" required="required" name="category">
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}"
                                            @if($category->id == $resource->cat_id)
                                               selected = "selected"
                                            @endif
                                            >
                                                {{$category->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="input-group resource-fields">
                                    <span class="input-group-addon"> <i
                                                class="fa fa-dashboard"></i>
                                    </span>
                                    <textarea name="description"
                                              class="form-control"
                                              placeholder="Description" rows="5" cols="">{{$resource->description}}</textarea>
                                </div>
                                <button class="btn btn-lg btn-primary btn-block" type="submit">Update Resource</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection