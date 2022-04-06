@extends('layouts.master')
@section('main-content')
    <div class="col-md-12  mb-4">
        <div class="card text-left">

            <div class="card-body detail-page">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h4 class="card-title mb-2">Support Request</h4>
                    </div>
                    <div class="col-md-6">
                        <div class="dropdown">
                            <div class="user align-self-end text-right">
                                <a href="{{route('support-requests')}}" class="btn btn-primary btn-rounded">Back</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="mt-5">Name: {{$request->name_en}}</h5>
                        <h6 class="mt-3">By: {{$request->client_email}}</h6>
                        <h6 class="mt-3">Status: <span
                                class="badge badge-{{$request->status ? 'primary' : 'danger'}}">{{$request->status ? 'Closed' : 'Open'}}</span>
                        </h6>
                        <p class="mt-3">{{$request->message}}</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- end of col -->
@endsection
