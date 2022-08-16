<template>
    <div class="container py-5">

        <div class="row justify-content-center">

            <div class="col-sm-5">

                <h1 class="text-center pt-5 pb-3">Reset Password</h1>

                <div class="alert alert-success" v-if="sendmessage">
                    {{ sendmessage }}
                </div>
                
                <form class="p-2" @submit.prevent="submit">

                    <div class="form-group">
                        
                        <input type="email" class="form-control" id="inputEmail" placeholder="Email" v-model="form.email">
                        <div class="form-text text-danger" v-if="errors.email">
                            {{ errors.email[0] }}
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block" @click.prevent="submit">Send</button>

                </form>

            </div>

        </div>

    </div>
</template>

<script>
import Axios from 'axios';


export default{
    middelware : "guest",

    data(){
        return {
            form: {
                email : ""
            },
            errors : {},
            sendmessage : ""
        }
    },

    methods : {
        submit() {
            Axios.post('/password/email', this.form).then(res => {

                this.sendmessage = res.data.message;

            }).catch(e => {

                this.errors = e.response.data.errors;

            });
        }
    }

}
</script>