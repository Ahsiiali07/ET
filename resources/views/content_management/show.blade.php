@extends('layouts.master')
@section('main-content')
    <div class="col-md-12  mb-4">
        <div class="card text-left">

            <div class="card-body detail-page">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h4 class="card-title mb-2">View Content</h4>
                    </div>
                    <div class="col-md-6">
                        <div class="dropdown">
                            <div class="user align-self-end text-right">
                                <a href="{{route('cms')}}" class="btn btn-primary btn-rounded">Back</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table office-table-view">
                    <ul class="list-group">
                        @if($item->type == \App\Services\ContentManagement\IContentManagement::TYPE_IMAGE)
                        <li class="list-group-item active office-name-li">
                            @if($item->content)
                                <div class="mt-3 mb-3">
                                    <img id="target" class="office-logo rounded img-thumbnail"
                                         src="{{ asset('public/'.$item->content ?? null) }}" alt="">
                                </div>
                            @endif
                            <b>{{$item->name}}</b>
                        </li>
                        @else
                        <li class="list-group-item active office-name-li">
                            <b>{{$item->name}}</b>
                        </li>
                        @endif
                        <div class="office-detail-row">
                            <li class="list-group-item width-50"><strong>Name</strong></li>
                            <li class="list-group-item width-50">{{$item->name}}</li>
                        </div>
                        <div class="office-detail-row">
                            <li class="list-group-item width-50"><strong>Slug</strong></li>
                            <li class="list-group-item width-50">{{$item->slug}}</li>
                        </div>
                        @if($item->type == \App\Services\ContentManagement\IContentManagement::TYPE_TEXT)
                        <div class="office-detail-row">
                            <li class="list-group-item width-50">
                                <h5>Content</h5>
                                {{$item->content}}
                            </li>
                        </div>
                        @endif
                    </ul>
                </div>
            </div>
        </div>

    </div>
    <!-- end of col -->
@endsection
