@extends('layouts.app')

@section('title')
    All Resources
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col col-sm-3">
                @include('includes.category')
            </div>
            <div class="col col-sm-9">
                <div class="row" id="resources">
                    @foreach($resources as $resource)
                        <div class="col s6 m6">
                            <div class="card card-right section">
                                <div class="video-container">
                                    <iframe src="{{ $resource->link }}" frameborder="0" allowfullscreen></iframe>
                                </div>
                                <div class="row center">
                                    {{ $resource->description }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection