@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h2>Ask Question</h2>
                            <div class="ml-auto">
                                <a href="{{route('questions.index')}}" class="btn btn-secondary">Back to all question</a>
                            </div>
                        </div>

                    </div>

                    <div class="card-body">
                        <form action="{{route('questions.store')}}" method="post">

                            @csrf
                            <div class="form-group">
                                <lable for="question-title">Question title</lable>
                                <input type="text" id="question-title" name="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : ''}}" value="{{old('title')}}" >

                                @if($errors->has('title'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </div>
                                @endif

                            </div>
                            <div class="form-group">
                                <lable for="question-body">Explain your question</lable>
                                <textarea name="body" id="question-body" cols="30" rows="10" class="form-control {{ $errors->has('body') ? 'is-invalid' : ''}}" value="{{old('body')}}"></textarea>

                                @if($errors->has('body'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('body') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-outline-primary bg-light" value="Ask this question">
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
