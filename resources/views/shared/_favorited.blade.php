<a href="" title="Click to mark as favorite question (Click again to udno)" class="favorite mt-2  {{\Illuminate\Support\Facades\Auth::guest() ? 'off' :
                                    ($model->is_favorited ? 'favorited' : '')}}"
   onclick="event.preventDefault(); document.getElementById('favorite-question-{{$model->id}}').submit();"
>
    <i class="fas fa-star fa-2x"></i>
    <span class="favorite-count">{{$model->favorites_count}}</span>
</a>
<form style="display: none" action="/questions/{{$model->id}}/favorites" method="POST" id="favorite-question-{{$model->id}}">
    @csrf
    @if($model->is_favorited)
        @method('DELETE')
    @endif
</form>
