@csrf
<div class="form-group">
    <lable for="question-title">Question title</lable>
    <input type="text" id="question-title" name="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : ''}}" value="{{old('title',$question->title)}}" >

    @if($errors->has('title'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('title') }}</strong>
        </div>
    @endif

</div>
<div class="form-group">
    <lable for="question-body">Explain your question</lable>
    <textarea name="body" id="question-body" cols="30" rows="10" class="form-control {{ $errors->has('body') ? 'is-invalid' : ''}}" >{{old('body',$question->body)}}</textarea>

    @if($errors->has('body'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('body') }}</strong>
        </div>
    @endif
</div>
<div class="form-group">
    <input type="submit" class="btn btn-outline-primary bg-light" value="{{ $buttonText }}">
</div>
