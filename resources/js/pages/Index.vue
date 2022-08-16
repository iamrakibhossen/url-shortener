<template>

    <div class="container py-5 mb-5">

        <div class="row justify-content-center">
            <div class="col-sm-6">

                <h1 class="text-center pt-5 pb-3">Shorten Your <span class="text-danger">Long</span> URL</h1>

                <form class="mt-4 mb-5" @submit.prevent="submit">

                    <div class="input-group input-group-lg mb-3">
                        <input type="text" class="form-control" placeholder="Paste url here" v-model="original_url">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button" @click="submit">Shorten</button>
                        </div>
                    </div>

                    <div class="text-danger text-center form-text" v-if="errors.original_url">{{ errors.original_url[0] }}</div>

                </form>
            </div>

            <div class="col-sm-9">
                <div class="my-5 table-responsive border">

                    <table class="table" v-if="items.data && items.data.length > 0">
                        <thead>
                            <th>Original URL</th>
                            <th>Shorten URL</th>
                            <th>Visits</th>
                            <th>Created</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <tr v-for="item in items.data" :key="item.id">
                                <td>{{ item.original_url.slice(0, 50) }}</td>
                                <td>
                                    <span class="cursor-pointer" @click="copyToClipBoard(item.path)">{{ item.shorten_url }}</span>
                                </td>
                                <td>{{ item.visits }}</td>
                                <td>{{ item.created_at }}</td>
                                
                                <td>
                                    <span @click="destroy(item)" class="btn btn-outline-danger btn-sm">x</span>
                                    <a :href="item.path" target="_blank" class="ml-2 btn btn-warning btn-sm">
                                        View
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot class="w-100">
                            <tr>
                                <td colspan="5">
                                    <div class="d-flex justify-content-center">
                                        <a href="" @click.prevent="prev" class="btn btn-success btn-sm" :class="items.current_page == 1 ? 'disabled' : ''">Prev</a>
                                        <a href="" @click.prevent="next" class="btn btn-success btn-sm ml-3" :class="items.current_page == items.last_page ? 'disabled' : ''">Next</a>
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="text-center pt-3" v-else>
                        <p>Not found yet.</p>
                    </div>
                </div>
            </div>
        </div>

    </div>

</template>

<script>
import Axios from 'axios';


    export default{
        
        middelware : "auth",

        data() {
            return{
                original_url : "",
                errors : {},
                items : []
            }
        },

        mounted(){
            this.fetchData(this.$route.query.page);
        },

        methods : {

            submit(){

                if( this.original_url == '') return;

                Axios.post('/url', {
                    original_url : this.original_url
                }).then(res => {
                    this.errors = "";
                    this.original_url = "";
                    this.items.data.unshift( res.data );

                    alert('Url Shorted Successfully.');

                }).catch(e => {
                    this.errors = e.response.data.errors;
                });
            },

            fetchData(page = 1){

                page = page ? page : 1;

                this.$router.replace({
                    query : {
                        page : page
                    }
                });

                Axios.get(`/url?page=${page}`).then(res => {

                    this.items = res.data;

                }).catch(e => {
                    this.errors = e.response.data.errors;
                });

            },

            destroy(item){

                if( confirm('Are you sure?') ){
                    
                    Axios.delete('/url/'+item.shorten_url).then(res => {

                        this.items.data = this.items.data.filter(i => i.id != item.id );

                    });
                }
            },

            copyToClipBoard(url){
                navigator.clipboard.writeText( url );
            },

            next(){

                let page = this.items.current_page + 1;

                if( this.items.last_page == this.items.current_page) return;

                this.fetchData( page );

            },

            prev(){

                let page = this.items.current_page - 1;

                if( page == 0) return;

                this.fetchData( page );

            }
            
        }

    }
</script>