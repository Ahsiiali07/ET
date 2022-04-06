@extends('layouts.master')
@section('title', 'Show')
@section('main-content')
    <div class="row">
        <div class="col-md-6">
            <h4 class="card-title mb-2">Documents</h4>
        </div>
        <div class="col-md-6">
            <div class="dropdown">
                <div class="user align-self-end text-right">
                    <a href="{{redirect()->back()}}" class="btn btn-primary btn-rounded">Back</a>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-5">

    @if($items->count())
        @foreach($items as $key => $item)
        <div class="card text-left mb-4">

            <div class="card-body detail-page">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <h4 class="card-title mb-2">{{$item['name']}}</h4>
                    </div>
                    <div class="col-md-12 mb-2">
                        <div class="dropdown">
                            <div class="user align-self-end">
                                <a href="{{ asset('public/storage/'.$item->url ?? null) }}" style="font-size: 30px;" target="_blank">
                                    <i class="nav-icon i-File font-weight-bold"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        @endforeach
    @else
        <p class="fs-16 font-weight-bold text-red text-center">Documents not yet uploaded!</p>
    @endif
    </div>
@endsection
