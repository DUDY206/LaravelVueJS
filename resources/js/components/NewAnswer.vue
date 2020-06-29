<template>
    <div class="row mt-4" >
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h3>Your answer</h3>
                    </div>
                    <hr>
                    <form @submit.prevent="create">
                        <div class="form-group">
                            <textarea name="body" id="" cols="30" rows="10" class="form-control" required v-model="body" ></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" :disabled="isInvalid" class="btn btn-lg btn-outline-primary" value="Submit">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>


</template>

<script>
    export default {
        name: "NewAnswer",
        props:['questionId'],
        data(){
            return {
                body: '',
            }

        },
        computed:{
            isInvalid(){
                return !this.signedIn || (this.body.length < 10);
            }
        },
        methods:{
            create(){
                axios.post(`/questions/${this.questionId}/answers`,{
                    body: this.body
                })
                .catch(error=>{
                    this.$toast.error(error.response.data.message,"Error")
                })
                .then(({data}) => {
                    this.$toast.success(data.message,"Success");
                    this.body = '';
                    this.$emit('created',data.answer);
                })
                ;
            }
        }

    }
</script>

<style scoped>

</style>
