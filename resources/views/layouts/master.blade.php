<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="/public/images/bb.jpg" rel="icon">
    <link href="/public/images/bb.jpg" rel="ET">

    <title>ET</title>
    <link href="{{asset('https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900')}}" rel="stylesheet">
    <link rel="stylesheet"
          href="{{asset('https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css')}}">
    @yield('before-css')
    {{-- theme css --}}
    <link id="gull-theme" rel="stylesheet" href="{{asset('public/assets/styles/css/themes/lite-purple.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/styles/vendor/perfect-scrollbar.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/styles/css/session.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/styles/css/responsive.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/styles/vendor/toastr.css')}}">

    {{-- Font Awesome Css--}}
    <link rel="stylesheet" href="{{asset('public/assets/styles/css/all.min.css')}}">
    {{-- Sweet Alert Css--}}
    <link rel="stylesheet" href="{{asset('public/assets/styles/vendor/sweetalert2.min.css')}}">

    {{-- DatePicker Css--}}
    <link rel="stylesheet" href="{{asset('public/assets/styles/css/datepicker.min.css')}}">

    <link rel="stylesheet" href="{{asset('public/assets/styles/css/custom/style.css')}}">
    <script src="{{asset('public/assets/js/common-bundle-script.js')}}"></script>
    <script src="{{asset('public/assets/plugins/datepicker/datepicker.min.js')}}"></script>
    <script src="{{asset('https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js')}}"></script>

    {{-- page specific css --}}
    @yield('page-css')
</head>

<body class="text-left">

<!-- ============ Large SIdebar Layout start ============= -->

{{-- normal layout --}}
<div class="app-admin-wrap layout-sidebar-large clearfix">
@include('layouts.header-menu')
{{-- end of header menu --}}



@include('layouts.sidebar')
{{-- end of left sidebar --}}

<!-- ============ Body content start ============= -->
    @include('partials.loader')
    <div class="main-content-wrap sidenav-open d-flex flex-column">
        <div class="main-content">
            @yield('main-content')
        </div>

        @include('layouts.footer')
    </div>
    <!-- ============ Body content End ============= -->

</div>
<!--=============== End app-admin-wrap ================-->

<!-- ============ Search UI Start ============= -->
@include('layouts.search')
<!-- ============ Search UI End ============= -->

<!-- ============ Large Sidebar Layout End ============= -->

<!-- ============ Modal Layout Start ============= -->

<div id="generic-modal" class="modal fade" tabindex="-1" role="dialog"
     aria-labelledby="generic-modal-title" aria-hidden="true">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="generic-modal-title">
                    Modal Title
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>

            <div class="modal-body">
                {{-- Modal Content --}}
            </div>

            <div class="modal-footer">
                <button class="btn btn-primary btn-modal-save"
                        onclick="$(this).closest('.modal').find('.submit').trigger('click')">
                    Save
                </button>
                <button type="button" class="btn btn-secondary btn-modal-close" data-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

<!-- ============= Modal Layout End ============== -->


{{-- common js --}}
<script src="{{asset('public/assets/js/vendor/toastr.min.js')}}"></script>
<script src="{{asset('public/assets/js/custom/pagination.js')}}"></script>
{{-- page specific javascript --}}
@yield('page-js')
@yield('sweetalert-page-js')

{{-- theme javascript --}}
<script src="{{asset('public/assets/js/es5/script.min.js')}}"></script>
<script src="{{asset('public/assets/js/es5/sidebar.large.script.min.js')}}"></script>

{{-- Font Awesome Js--}}
{{--<script src="{{asset('public/assets/js/all.min.js')}}"></script>--}}
<script src="{{asset('public/assets/js/es5/customizer.script.min.js')}}"></script>

{{-- Custom Js --}}
<script src="{{asset('public/assets/js/custom/custom.js')}}"></script>
<script src="{{asset('public/assets/js/custom/ajax.js')}}"></script>
@yield('bottom-js')
@include('partials.flash_messages')
</body>
</html>
