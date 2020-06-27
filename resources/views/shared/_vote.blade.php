@if($model instanceof App\Question)
    @php
        $name = 'question';
        $firstURISegment = 'questions';
    @endphp
@elseif($model instanceof App\Answer)
    @php
        $name = 'answer';
        $firstURISegment = 'answers';
    @endphp
@endif
@php
    $formId = $name."-".$model->id;
    $formAction = "/{$firstURISegment}/{$model->id}/vote";
@endphp
<div class="d-flex flex-column vote-controls">
    <a href="" title="This {{$name}} is useful"
       class="vote-up {{\Illuminate\Support\Facades\Auth::guest() ? 'off' : ''}}"
       onclick="event.preventDefault(); document.getElementById('up-vote-{{$formId}}').submit();"
    >
        <i class="fas fa-caret-up fa-2x"></i>
    </a>
    <form style="display: none" action="{{$formAction}}" method="POST" id="up-vote-{{$formId}}">
        @csrf
        <input type="hidden" name="vote" value="1">
    </form>
    <span class="votes-count">{{$model->votes_count}}</span>
    <a
        class="vote-down {{\Illuminate\Support\Facades\Auth::guest() ? 'off' : ''}}" href="" title="This {{$name}} is not useful"
        onclick="event.preventDefault(); document.getElementById('down-vote-{{$formId}}').submit();"
    >
        <i class="fas fa-caret-down fa-2x"></i>
    </a>
    <form style="display: none" action="{{$formAction}}" method="POST" id="down-vote-{{$formId}}">
        @csrf
        <input type="hidden" name="vote" value="-1">
    </form>
    @if($model instanceof App\Question)
        <favorite :question="{{$model}}"></favorite>
    @elseif($model instanceof App\Answer)
        @include('shared._accept',[
            'model' => $model,
        ])
    @endif
</div>
