<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <form class="card-body" v-if="editing" @submit.prevent="update">
                    <div class="card-title">
                        <input type="text"class="form-control form-control-lg" v-model="title">

                    </div>

                    <div class="media">
                        <div class="media-body">
                            <div class="form-group">
                                <textarea v-model ="body" rows="10" class="form-control" required></textarea>
                            </div>
                            <button  class="btn btn-primary" :disabled="isInvalid">Update</button>
                            <button @click="cancel" class="btn btn-outline-primary">Cancel</button>
                        </div>
                    </div>
                </form>
                <div v-else class="card-body">
                    <div class="card-title">
                        <div class="d-flex align-items-center">
                            <h1>{{title}}</h1>
                            <div class="ml-auto">
                                <a href="/questions" class="btn btn-outline-secondary">Back to all questions</a>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="media">
                        <vote :model="question" name="question"></vote>

                        <div class="media-body">
                            <div v-html="bodyHtml"></div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="ml-auto">
                                        <a v-if="authorize('modify',question)" @click.prevent="edit" class="btn btn-sm btn-outline-primary">Edit</a>
                                        <button v-if="authorize('deleteQuestion',question)" @click.prevent="destroy" class="btn btn-sm btn-outline-danger">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Vote from "./Vote";
    import UserInfo from "./UserInfo.vue";
    import modification from "../mixins/modification";
    export default {
        name: "Question",
        props: ['question'],
        mixins:[modification],
        components:{
            Vote,UserInfo
        },
        data(){
            return{
                title:this.question.title,
                body: this.question.body,
                bodyHtml:this.question.body_html,
                id:this.question.id,
                beforeEditCache: {}
            }
        },

        computed:{
            isInvalid(){
                return this.body.length < 10 || this.title.length < 10;
            },
            endpoint(){
                return `/questions/${this.id}`;
            }
        },
        methods:{
            setEditCache(){
                this.beforeEditCache = {
                    body:this.body,
                    title:this.title
                };
            },
            restoreFromCache(){
                this.body = this.beforeEditCache.body;
                this.title = this.beforeEditCache.title;
            },
            payload(){
                return {
                    body: this.body,
                    title:this.title
                }
            },
            delete(){
                axios.delete(this.endpoint)
                    .then(res => {
                        this.$toast.success(res.data.message,"Success",{timeout:3000});
                        this.$emit('deleted')
                    })

                    setTimeout(() =>{
                        window.location.href = "questions";
                    },3000);
            }
        }

    }
</script>

<style scoped>

</style>
