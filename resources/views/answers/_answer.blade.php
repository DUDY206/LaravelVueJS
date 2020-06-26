<answer :answer="{{ $answer }}" inline-template>
    <div class="media post">
        @include('shared._vote',[
             'model' => $answer,
         ])
        <div class="media-body">
            <form @submit.prevent="update" v-if="editing"  >
                <div class="form-group">
                    <textarea v-model ="body" rows="10" class="form-control" required>

                    </textarea>
                </div>
                <button  class="btn btn-primary" :disabled="isInvalid">Update</button>
                <button @click.prevent="editing = false" class="btn btn-outline-primary">Cancel</button>
            </form>
            <div v-else>
                <div v-html="bodyHtml"></div>
                <div class="row">
                    <div class="col-4">
                        <div class="ml-auto">
                            @can('update',$answer)
                                <a @click.prevent="editing = true" class="btn btn-sm btn-outline-info">Edit</a>
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
                        <user-info :model="{{$answer}}" label="Answered"></user-info>
                    </div>
                </div>
            </div>
        </div>
    </div>

</answer>