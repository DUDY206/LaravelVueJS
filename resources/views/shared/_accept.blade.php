@can('accept',$model)
    <a href="" title="Mark this answer is the best answer"
       class="{{$model->status}} mt-2 "
       onclick="event.preventDefault(); document.getElementById('accept-answer-{{$model->id}}').submit();"
    >
        <i class="fas fa-check fa-2x"></i>
    </a>
    <form style="display: none" action="{{route('answers.accept',$model->id)}}" method="POST" id="accept-answer-{{$model->id}}">
        @csrf
    </form>
@else
    @if($model->is_best)
        <a href="" title="This is the best accepted answer"
           class="{{$model->status}} mt-2 "
        >
            <i class="fas fa-check fa-2x"></i>
        </a>
    @endif
@endcan
