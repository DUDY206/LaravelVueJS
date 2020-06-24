@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h1>{{$question->title}}</h1>
                            <div class="ml-auto">
                                <a href="{{route('questions.index')}}" class="btn btn-secondary">Back to all question</a>
                            </div>
                        </div>

                    </div>

                    <div class="card-body">
                        {!! $question->body_html !!}
                        <div class="float-right">
                            <span class="text-muted">Answered {{$question->created_date}}</span>
                            <div class="media">
                                <a href="{{ $question->user->url }}" class="pr-2"><img src="{{$question->user->avatar}}" alt=""></a>
                                <div class="media-body">
                                    <a href="{{ $question->user->url }}">{{ $question->user->name }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       @include('answers._index',[
            'answers' => $question->answers,
            'answersCount' => $question->answers_count
])
    </div>
@endsection
