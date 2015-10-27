@extends('layouts.app')

@section('title')
    @if(isset($title))
        {{$title}}
    @else
        Resources
    @endif
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col col-sm-3">
                @include('includes.category')
            </div>
            <div class="col col-sm-9">
                <div class="row" id="resources">
                    <h3 class="resource_title">
                        @if(isset($title))
                            {{$title}}
                        @else
                            All Resources
                        @endif
                    </h3>
                    @if(sizeof($resources)==0)
                        <div class="row no-resource">
                           There are no resources available for this category
                        </div>
                    @endif
                    <div class="panel-group">
                    @foreach($resources as $resource)
                        <div class="panel panel-default col-sm-6">
                            <div class="panel-heading">
                                <a href="{{route('resource.show',['id' =>$resource->id])}}" >{{ $resource->title}}</a>
                            </div>
                            <div class="panel-body">
                                <iframe src="{{ $resource->link }}" frameborder="0" allowfullscreen></iframe>
                            </div>
                        </div>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection