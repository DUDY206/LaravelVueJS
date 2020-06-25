<div class="media post">
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
