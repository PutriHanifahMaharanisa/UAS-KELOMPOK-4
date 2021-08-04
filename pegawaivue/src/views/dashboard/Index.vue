<template>
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        MAIN MENU
                        <hr>
                        <ul class="list-group">
                            <router-link :to="{name: 'dashboard'}" class="list-group-item bg-orange text-decoration-none">
                                HOME
                            </router-link>
                            <router-link :to="{name: 'pegawai'}" class="list-group-item bg-orange text-decoration-none">
                                DATA PEGAWAI
                            </router-link>
                            <li @click.prevent="logout" class="list-group-item bg-orange text-decoration-none"
                                style="cursor:pointer">LOGOUT</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        HOME
                        <hr>
                        Halo <strong>{{ user.name }} </strong>
                        <br/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { onMounted, ref } from 'vue'
import { useRouter } from 'vue-router'
import axios from 'axios'

    export default {

        setup() {

            //state token
            const token = localStorage.getItem('token')

            //inisialisasi vue router on Composition API
            const router = useRouter()

            //state user
            const user = ref('')
            
            //mounted properti
            onMounted(() =>{

                //check Token exist
                if(!token) {
                    return router.push({
                        name: 'login'
                    })
                }
                
                //get data user
                axios.defaults.headers.common.Authorization = `Bearer ${token}`
                axios.get('http://localhost/pegawai/public/api/user')
                .then(response => {

                    //console.log(response.data.name)
                    user.value = response.data

                })
                .catch(error => {
                    console.log(error.response.data)
                })

            })

            //method logout
            function logout() {

                //logout
                axios.defaults.headers.common.Authorization = `Bearer ${token}`
                axios.post('http://localhost/pegawai/public/api/logout')
                .then(response => {

                    if(response.data.success) {

                        //remove localStorage
                        localStorage.removeItem('token')

                        //redirect ke halaman login
                        return router.push({
                            name: 'login'
                        })

                    }

                })
                .catch(error => {
                    console.log(error.response.data)
                })

            }

            return {
                token,      // <-- state token
                user,       // <-- state user
                logout      // <-- method logout
            }

        }

    }
</script>
<style>
.card {
    background: midnightblue;
}
h4, .card-body {
    color: white;
}
.bg-orange {
    color:white;
    background: midnightblue;
    border-color: white;
}
</style>