@extends('layouts.app')

@section('content')
    <question-page :question="{{$question}}"></question-page>
{{--    <div class="container">--}}
{{--        <question :question="{{$question}}"></question>--}}
{{--       <answers :question="{{$question}}" :count="{{$question->answers_count}}"></answers>--}}
{{--    </div>--}}
@endsection
