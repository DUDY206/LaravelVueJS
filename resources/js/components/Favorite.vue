<template>
    <a href="" title="Click to mark as favorite question (Click again to udno)" :class="classes" @click.prevent="toggle">
        <i class="fas fa-star fa-2x"></i>
        <span class="favorite-count">{{count}}</span>
    </a>
</template>

<script>
    export default {
        name: "Favorite",
        props:['question'],

        data () {
          return {
              isFavorite: this.question.is_favorited,
              count:this.question.favorites_count,
              id:this.question.id,
          }
        },

        computed:{
            classes(){
                return [
                    'favorite', 'mt-2',
                    !this.signedIn ? 'off' : (this.isFavorite ? 'favorited' : ''),
                ]
            },
            endpoint(){
                return `/questions/${this.id}/favorites`;
            },
        },

        methods:{
            toggle(){
                if(!this.signedIn){
                    this.$toast.warning("Please login to favorite this question","Warning",{
                        timeout:3000,
                        position:'center',
                    })
                }else{
                    this.isFavorite ? this.destroy() : this.create();
                }
            },
            destroy(){
                axios.delete(this.endpoint)
                .then(res =>{
                    this.isFavorite = false;
                    this.count--;
                });
            },
            create(){
                axios.post(this.endpoint)
                .then(res => {
                    this.isFavorite = true;
                    this.count++;
                });
            },
        }
    }
</script>

<style scoped>

</style>
