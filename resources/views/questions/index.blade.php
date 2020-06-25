@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h2>All Question</h2>
                            <div class="ml-auto">
                                <a href="{{route('questions.create')}}" class="btn btn-secondary">Ask question</a>
                            </div>
                        </div>

                    </div>

                    <div class="card-body">
                        @include('layouts._messages')
                        @forelse($questions as $question)
                            <div class="media">
                                <div class="d-flex-column counters">
                                    <div class="vote">
                                        <strong>{{$question->votes_count}}</strong> {{str_plural('vote',$question->votes_count)}}
                                    </div>
                                    <div class="answer">
                                        <strong>{{$question->answers_count}}</strong> {{str_plural('answer',$question->answers_count)}}
                                    </div>
                                    <div class="views">
                                        {{$question->views.' '.str_plural('views',$question->views)}}
                                    </div>
                                </div>
                                <div class="media-body">
                                    <div class="d-flex align-items-center">
                                        <h3 class="mt-0"><a href="{{$question->url}}">{{$question->title}}</a>
                                        <div class="ml-auto">
                                                @can('update',$question)
                                            <a href="{{route('questions.edit',$question->id)}}" class="btn btn-sm btn-outline-info">Edit</a>
                                            @endcan
                                            @can('delete',$question)
                                                <form class="form-delete" action="{{route('questions.destroy',$question->id)}}" method="post">
                                                @method('DELETE')
                                                @csrf
                                                <input type="submit" class="btn btn-sm btn-outline-danger" value="Delete" ONCLICK="return confirm('Are you sure')">
                                                </form>
                                                    @endcan
                                        </div>
                                        </h3>

                                    </div>

                                    <p class="lead">
                                        Asked by
                                        <a href="{{$question->user->url}}">{{$question->user->name}}</a>
                                        <small class="text-muted">{{$question->created_date}}</small>
                                    </p>
                                    <div class="excerpt">{{  $question->excerpt(250) }}</div>
                                </div>
                            </div>
                            <hr>
                        @empty
                             <div class="alert alert-warning">
                                 <strong>Sorry</strong> There are no question available.
                             </div>
                        @endforelse
                            <div class="text-center"></div>
                        {{$questions->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
