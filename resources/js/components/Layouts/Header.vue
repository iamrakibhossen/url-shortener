<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <router-link class="navbar-brand" to="/">URL Shortener</router-link>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <router-link class="nav-link" to="/">Home</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/about">About US</router-link>
                    </li>
                
                </ul>
                <div class="d-flex" v-if="loggedIn">
                    <div class="btn mr-3">Hi, {{ user.name }}</div>
                    <a href="" class="btn btn-danger" @click.prevent="logout">Logout</a>
                </div>
                <div class="d-flex" v-else>
                    <router-link to="/register" class="btn btn-outline-success mr-3">Register</router-link>
                    <router-link to="/login" class="btn btn-danger">Login</router-link>
                </div>
            </div>
        </nav>
    </div>
</template>

<script>
import Axios from 'axios';

    export default {
        data(){
            return {
                loggedIn : window.loggedIn,
                user : window.user
            }
        },
        methods : {

            logout(){
                Axios.post('/logout').then(res => window.location = '/login');
            }
        }
    }
</script>