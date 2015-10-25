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

                    @can('update-resource', $resource)
                    <div class="btn-group action_button">
                        <a href="{{route('resource.edit',['id' =>$resource->id])}}" class="btn btn-primary">Edit
                            Resource</a>
                        <a href="/resources" class="btn btn-danger"
                           data-confirm="Are you sure you want to delete?">
                            Delete Resource
                        </a>
                    </div>

                    <script type="text/javascript">
                        $(document).ready(function () {
                            $('a[data-confirm]').click(function (ev) {
                                var href = $(this).attr('href');
                                if (!$('#dataConfirmModal').length) {
                                    $('body').append('<div id="dataConfirmModal" class="modal" role="dialog" aria-labelledby="dataConfirmLabel" aria-hidden="true"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button><h3 id="dataConfirmLabel">Please Confirm</h3></div><div class="modal-body"></div><div class="modal-footer"><button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button><a class="btn btn-primary" id="dataConfirmOK">OK</a></div></div>');
                                }
                                $('#dataConfirmModal').find('.modal-body').text($(this).attr('data-confirm'));
                                $('#dataConfirmOK').attr('href', href);
                                $('#dataConfirmModal').modal({show: true});
                                return false;
                            });
                        });
                    </script>
                    @endcan
                </div>
            </div>
        </div>
    </div>
@endsection