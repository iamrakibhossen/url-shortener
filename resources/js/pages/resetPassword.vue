<template>
    <div class="container py-5">

        <div class="row justify-content-center">

            <div class="col-sm-5">

                <h1 class="text-center pt-5 pb-3">Reset Password</h1>
                
                
                <form class="p-2" @submit.prevent="submit">

                    <div class="form-group">
                        <label for="inputEmail">Email</label>
                        <input type="email" class="form-control" id="inputEmail" placeholder="email" v-model="form.email">
                        <div class="form-text text-danger" v-if="errors.email">
                            {{ errors.email[0] }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputPassword">New Password</label>
                        <input type="password" class="form-control" id="inputPassword" placeholder="Password" v-model="form.password">
                        <div class="form-text text-danger" v-if="errors.password">
                            {{ errors.password[0] }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputConfirmationPassword">Confirm Password</label>
                        <input type="password" class="form-control" id="inputConfirmationPassword" placeholder="Confirm password" v-model="form.password_confirmation">
                    </div>



                    <button type="submit" class="btn btn-primary btn-block" @click.prevent="submit">Update Password</button>

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
            form : {
                email: "",
                token : "",
                password : "",
                password_confirmation : ""
            },
            errors : {},
            errormessge : "",
        }
    },

    mounted() {
        this.form.email = this.$route.query.email;
        this.form.token = this.$route.params.token;

        console.log( this.$route );
    },

    methods : {

        submit(){

                Axios.post('/password/reset', this.form).then( res => {

                    window.location = "/";

                }).catch( e => {

                    this.errors = e.response.data.errors;

                    this.errormessge =  e.response.data.message;

                });

            }
    }

}


</script>