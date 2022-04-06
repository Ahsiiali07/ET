@extends('layouts.master')
@section('title', 'Show')
@section('main-content')
    <div class="row">
        <div class="col-md-6">
            <h4 class="card-title mb-2">Questionnaire</h4>
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
        @foreach($items as $key => $answer)
        <div class="card text-left mb-4">

            <div class="card-body detail-page">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <h4 class="card-title mb-2">{{$answer['question']['question']}}</h4>
                    </div>
                    <div class="col-md-12 mb-2">
                        <div class="dropdown">
                            <div class="user align-self-end">
                                @if($answer['question']['type'] == \App\Services\IQuestionType::FILE )
                                    <a href="{{ asset('public/storage/'.$item->url ?? null) }}">
                                        <i class="nav-icon i-File font-weight-bold"></i>
                                    </a>
                                @else
                                    <p>{{$answer['answer']}}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        @endforeach
    @else
        <p class="fs-16 font-weight-bold text-red text-center">Questionnaire not yet filled!</p>
    @endif
    </div>
@endsection
