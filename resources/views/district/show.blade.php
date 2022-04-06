@extends('layouts.master')
@section('main-content')
    <div class="col-md-12  mb-4">
        <div class="card text-left">

            <div class="card-body detail-page">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h4 class="card-title mb-2">district Details</h4>
                    </div>
                    <div class="col-md-6">
                        <div class="dropdown">
                            <div class="user align-self-end text-right">
                                <a href="{{route('districts')}}" class="btn btn-primary btn-rounded">Back</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table office-table-view">
                    <ul class="list-group">
                        <li class="list-group-item active office-name-li">
                            @if($item->image_url)
                                <div class="mt-3 mb-3">
                                    <img id="target" class="office-logo rounded img-thumbnail"
                                         src="{{ asset('public/storage/'.$item->image_url ?? null) }}" alt="">
                                </div>
                            @endif

                        </li>
                        <div class="office-detail-row">
                            <li class="list-group-item width-50"><strong>Name</strong></li>
                            <li class="list-group-item width-50">{{$item->name}}</li>
                        </div>
                        <div class="office-detail-row">
                            <li class="list-group-item width-50"><strong>Description</strong></li>
                            <li class="list-group-item width-50">{{$item->description}}</li>
                        </div>
                        <div class="office-detail-row">
                            <li class="list-group-item width-50"><strong>Image</strong></li>
                            <li class="list-group-item width-50">
                                <img height="50" src="{{ asset('public/'.$item->image_url ?? null) }}" class="rounded-circle m-0 avatar-sm-table"></li></li>
                        </div>
                    </ul>
                </div>
            </div>
        </div>

    </div>
    <!-- end of col -->
@endsection
