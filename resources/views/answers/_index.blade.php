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
                            <a href="" title="This question is useful">
                                <i class="fas fa-caret-up fa-2x"></i>
                            </a>
                            <span class="votes-count">1230</span>
                            <a class="vote-down off" href="" title="This question is not useful">
                                <i class="fas fa-caret-down fa-2x"></i>
                            </a>
                            <a href="" title="Mark this answer is the best answer" class="vote-accepted mt-2 ">
                                <i class="fas fa-check fa-2x"></i>
                                <span class="favorite-count">123</span>
                            </a>
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