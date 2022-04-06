@extends('layouts.master')
@section('page-css')
    <link rel="stylesheet" href="{{asset('public/assets/styles/vendor/datatables.min.css')}}">
@endsection

@section('main-content')
    <div class="row mb-4">
        <div class="col-md-12 mb-4">
            <div class="card text-left">
                <div class="card-body">
                    <div class="row p-3 items-align-center">
                        <div class="col-md-6">
                            <h4 class="card-title">Support Requests</h4>
                        </div>
{{--                        <div class="col-md-6 text-right">--}}
{{--                            <a href="{{route('')}}" class="btn btn-primary btn-rounded">--}}
{{--                                Create FeedBack--}}
{{--                            </a>--}}
{{--                        </div>--}}
                    </div>


                    <section>

                        {{-- Contains Companies List Table --}}
                        <div id="itemlist">

                            @include('support._list')
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('bottom-js')
    <script>
        // Order status success form
        $(".close-form, .open-form").on(
            "form-success-event",
            function (event, responsse) {

                if (responsse.type == "success") {
                    location.reload();
                }
            }
        );
    </script>
@endsection
@section('page-js')
    <script src="{{asset('public/assets/js/vendor/sweetalert2.min.js')}}"></script>
@endsection
