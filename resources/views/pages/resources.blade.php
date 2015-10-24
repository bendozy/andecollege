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
                    @if(! isset($resources))
                        <div class="row">
                           No Resource Available
                        </div>
                    @endif
                    @foreach($resources as $resource)
                        <div class="col s6 m6">
                            <div class="card card-right section">
                                <div class="video-container">
                                    <iframe src="{{ $resource->link }}" frameborder="0" allowfullscreen></iframe>
                                    <div class="row center">
                                        <a href="{{route('resource.show',['id' =>$resource->id])}}" >{{ $resource->title}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection