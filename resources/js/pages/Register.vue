<template>
    <div class="container py-5">

        <div class="row justify-content-center">

            <div class="col-sm-5">

                <h1 class="text-center pt-2 pb-3">Register</h1>

                <div class="alert alert-danger" v-if="errors.email">
                    {{ errors.email[0] }}
                </div>
                <div class="alert alert-danger" v-else-if="errors.password">
                    {{ errors.password[0] }}
                </div>
                <div class="alert alert-danger" v-else-if="errors.name">
                    {{ errors.name[0] }}
                </div>
                
                <form class="p-2" @submit.prevent="submit">

                    <div class="form-group">
                        <label for="inputName">Name</label>
                        <input type="text" class="form-control" id="inputName" placeholder="Your name" v-model="form.name" required>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail">Email</label>
                        <input type="email" class="form-control" id="inputEmail" placeholder="Email" v-model="form.email" required>
                    </div>

                    <div class="form-group">
                        <label for="inputPassword">Password</label>
                        <input type="password" class="form-control" id="inputPassword" placeholder="Password" v-model="form.password" required>
                    </div>

                    <div class="form-group">
                        <label for="inputConfirmPassword">Confirm Password</label>
                        <input type="password" class="form-control" id="inputConfirmPassword" placeholder="Password" v-model="form.password_confirmation" required>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block" @click.prevent="submit">Register</button>

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
                    name : "",
                    email : "",
                    password : "",
                    password_confirmation : ""
                },
                errors : {}
            }
        },

        methods : {

            submit(){

                Axios.post('/register', this.form).then( res => {

                    window.location = '/';

                }).catch( e => {

                    this.errors = e.response.data.errors;

                    console.log( this.errors );

                });

            }
        }

    }

</script>