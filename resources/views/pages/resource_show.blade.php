@extends('layouts.app')

@section('title')
    {{$resource->title}}
@endsection

@section('content')
    <div class="row">
        <div class="col col-sm-3">
            @include('includes.category')
        </div>
        <div class="col col-sm-9">
            <div class="omb_login">
                <div class="col-xs-12 col-sm-6">
                    <h3 class="resource_title">{{strtoupper($resource->title)}}</h3>
                    <iframe width="640" height="480"
                            src="{{ $resource->link }}" frameborder="0" allowfullscreen></iframe>

                    <div class="row center resource-data">
                        Category : <a href="{{route('resource.cat',['name' =>$resource->category->name])}}">
                            {{$resource->category->name}}</a>
                    </div>

                    <div class="row center resource-data">
                        Uploader : <a href="#">
                            {{$resource->user->firstname}} {{$resource->user->lastname}}</a>
                    </div>

                    <div class="row center">
                        <h3 class="resource_desc_label">Description</h3>

                        <div class="row center resource_description">
                            {{ $resource->description}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection