<template>
    <div class="container py-5">

        <div class="row justify-content-center">

            <div class="col-sm-5">

                <h1 class="text-center pt-2 pb-3">Login</h1>

                <div class="alert alert-danger" v-if="error">
                    {{ error }}
                </div>
                
                <form class="p-2" @submit.prevent="submit">

                    <div class="form-group">
                        <label for="inputEmail">Email</label>
                        <input type="email" class="form-control" id="inputEmail" placeholder="Email" v-model="form.email">
                    </div>

                    <div class="form-group">
                        <label for="inputPassword">Password</label>
                        <input type="password" class="form-control" id="inputPassword" placeholder="Password" v-model="form.password">
                    </div>

                    <div class="form-group d-flex justify-content-between">
                        <div>
                            <label class="form-check-label" for="remember"><input id="remember" type="checkbox" value="1" v-model="form.remember"> Remember me</label>
                        </div>
                        <div>
                            <router-link to="/forgot-password">
                                Forgot password?
                            </router-link>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block" @click.prevent="submit">Login</button>

                </form>

            </div>

        </div>

    </div>
</template>

<script>

import Axios from 'axios';

    export default {
        middelware : "guest",
        data(){
            return {
                form : {
                    email : "",
                    password : "",
                    remember : ""
                },
                error : ""
            }
        },

        methods : {

            submit(){

                Axios.post('/login', this.form).then( res => {

                    window.location = '/';

                }).catch( e => {

                    this.error = e.response.data.message;

                    // console.log( e.response.data.message );

                });

            }
        }

    }

</script>