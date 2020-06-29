export default {
    data(){
        return {
            editing : false,
            body : this.answer.body,
            bodyHtml:this.answer.body_html,
            id: this.answer.id,
            questionId:this.answer.question_id,
            beforeEditCache: null,
        }
    },
    methods:{
        edit(){
            this.setEditCache()
            this.editing = true;
        },
        cancel(){
            this.restoreFromCache()
            this.editing = false;
        },

        setEditCache(){},
        restoreFromCache(){},

        update () {
            axios.patch(this.endpoint,this.payload)
            .then(res => {
                this.editing = false;
                this.bodyHtml = res.data.body_html;
                this.$toast.success(res.data.message,"Success",{timeout:3000});
            }).catch(err => {
                this.$toast.error(err.response,"Error",{timeout:3000});
            });
        },

        payload(){

        },
        destroy(){
            this.$toast.question("Are you sure delete this answer?","Confirm",{
                timeout: 20000,
                close: false,
                overlay: true,
                displayMode: 'once',
                id: 'question',
                zindex: 999,
                position: 'center',
                buttons: [
                    ['<button><b>YES</b></button>',  (instance, toast) => {
                        this.delete();
                        instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

                    }, true],
                    ['<button>NO</button>', function (instance, toast) {

                        instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

                    }],
                ],

            });
        },
        delete(){

        }
    }
}
