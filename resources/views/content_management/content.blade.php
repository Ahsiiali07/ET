@extends('layouts.app1')
@section('content')
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
        <div class="container text-center">
            <h1 class="display-3">{{$title}}</h1>
        </div>
    </div>

    <div class="container">
        <!-- Example row of columns -->
        <div class="row" style="font-size: 16px;">
            {!! $content !!}
        </div>

        <hr>

    </div> <!-- /container -->
@endsection
