@extends('layouts.master')
@section('main-content')
    <div class="breadcrumb">
        <h1>Dashboard</h1>
    </div>

    <div class="separator-breadcrumb border-top"></div>

    <div class="row">

        <div class="col-lg-3 col-md-6 col-sm-6">
            <a href="{{route('users')}}">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center">
                        <i class="i-Checked-User"></i>
                        <div class="content">
                            <p class="text-muted mt-2 mb-0">Today's New Users</p>
                            <p class="text-primary text-24 line-height-1 mb-2">{{$toDaysUsers ?? 0}}</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
        <a href="{{route('users')}}">
            <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                <div class="card-body text-center">
                    <i class="i-Checked-User"></i>
                    <div class="content">
                        <p class="text-muted mt-2 mb-0">Last week's New Users</p>
                        <p class="text-primary text-24 line-height-1 mb-2">{{$lastWeekUsers ?? 0}}</p>
                    </div>
                </div>
            </div>
        </a>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <a href="{{route('users')}}">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center">
                        <i class="i-Checked-User"></i>
                        <div class="content">
                            <p class="text-muted mt-2 mb-0">Last Month's New Users</p>
                            <p class="text-primary text-24 line-height-1 mb-2">{{$lastMonthUsers ?? 0}}</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <a href="{{route('users')}}">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center">
                        <i class="i-Checked-User"></i>
                        <div class="content">
                            <p class="text-muted mt-2 mb-0">Total Registered Users</p>
                            <p class="text-primary text-24 line-height-1 mb-2">{{$totalUsers ?? 0}}</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

    </div>
@endsection

@section('page-js')
    <script src="{{asset('assets/js/es5/dashboard.v1.script.js')}}"></script>
@endsection
