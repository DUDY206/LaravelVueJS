<div class="row" mt-4>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h2>{{ $answersCount . " " .str_plural('Answer',$answersCount) }}</h2>
                </div>
                <hr>
                @include('layouts._messages')
                @foreach($answers as $answer)
                    <div class="media">
                        <div class="d-flex flex-column vote-controls">
                            <a href="" title="This answer is useful"
                               class="vote-up {{\Illuminate\Support\Facades\Auth::guest() ? 'off' : ''}}"
                               onclick="event.preventDefault(); document.getElementById('up-vote-answer-{{$answer->id}}').submit();"
                            >
                                <i class="fas fa-caret-up fa-2x"></i>
                            </a>
                            <form style="display: none" action="/answers/{{$answer->id}}/vote" method="POST" id="up-vote-answer-{{$answer->id}}">
                                @csrf
                                <input type="hidden" name="vote" value="1">
                            </form>
                            <span class="votes-count">{{$answer->votes_count}}</span>
                            <a
                                class="vote-down {{\Illuminate\Support\Facades\Auth::guest() ? 'off' : ''}}" href="" title="This answer is not useful"
                                onclick="event.preventDefault(); document.getElementById('down-vote-answer-{{$answer->id}}').submit();"
                            >
                                <i class="fas fa-caret-down fa-2x"></i>
                            </a>
                            <form style="display: none" action="/answers/{{$answer->id}}/vote" method="POST" id="down-vote-answer-{{$answer->id}}">
                                @csrf
                                <input type="hidden" name="vote" value="-1">
                            </form>
                            @can('accept',$answer)
                            <a href="" title="Mark this answer is the best answer"
                               class="{{$answer->status}} mt-2 "
                                onclick="event.preventDefault(); document.getElementById('accept-answer-{{$answer->id}}').submit();"
                            >
                                <i class="fas fa-check fa-2x"></i>
                            </a>
                            <form style="display: none" action="{{route('answers.accept',$answer->id)}}" method="POST" id="accept-answer-{{$answer->id}}">
                                @csrf
                            </form>
                            @else
                                @if($answer->is_best)
                                    <a href="" title="This is the best accepted answer"
                                       class="{{$answer->status}} mt-2 "
                                    >
                                        <i class="fas fa-check fa-2x"></i>
                                    </a>
                                @endif
                            @endcan
                        </div>
                        <div class="media-body">
                            {!! $answer->body_html !!}
                            <div class="row">
                                <div class="col-4">
                                    <div class="ml-auto">
                                        @can('update',$answer)
                                            <a href="{{route('questions.answers.edit',[$question->id,$answer->id])}}" class="btn btn-sm btn-outline-info">Edit</a>
                                        @endcan
                                        @can('delete',$answer)
                                            <form class="form-delete" action="{{route('questions.answers.destroy',[$question->id,$answer->id])}}" method="post">
                                                @method('DELETE')
                                                @csrf
                                                <input type="submit" class="btn btn-sm btn-outline-danger" value="Delete" ONCLICK="return confirm('Are you sure')">
                                            </form>
                                        @endcan
                                    </div>
                                </div>
                                <div class="col-4"></div>
                                <div class="col-4">
                                    <span class="text-muted">Answered {{$answer->created_date}}</span>
                                    <div class="media">
                                        <a href="{{ $answer->user->url }}" class="pr-2"><img src="{{$answer->user->avatar}}" alt=""></a>
                                        <div class="media-body">
                                            <a href="{{ $answer->user->url }}">{{ $answer->user->name }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <hr>
                @endforeach
            </div>
        </div>
    </div>
</div>
