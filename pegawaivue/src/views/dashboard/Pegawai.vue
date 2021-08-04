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
                        DATA PEGAWAI
                        <hr>
                        <router-link :to="{name : 'tambah'}" class="btn btn-md btn-success">
                            Tambah Post
                        </router-link>
                        <table class="table table-striped table-bordered mt-4">
                            <thead class="thead-dark">
                                <tr>
                                <th scoppe="col">NIP</th>
                                <th scoppe="col">Nama Pegawai</th>
                                <th scoppe="col">Jenis Kelamin</th>
                                <th scoppe="col">Alamat</th>
                                <th scoppe="col">Tempat Lahir</th>
                                <th scoppe="col">Tanggal Lahir</th>
                                <th scoppe="col">Email</th>
                                <th scoppe="col">No Telp</th>
                                <th scoppe="col">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(post, index) in posts" :key="index">
                                    <td>{{ post.nip }}</td>
                                    <td>{{ post.nama }}</td>
                                    <td>{{ post.jk }}</td>
                                    <td>{{ post.alamat }}</td>
                                    <td>{{ post.tempat_lahir }}</td>
                                    <td>{{ post.tgl_lahir }}</td>
                                    <td>{{ post.email }}</td>
                                    <td>{{ post.no_telp }}</td>
                                    <td>
                                        <router-link :to="{name: 'edit', params: {id: post.id}}"
                                        class="btn btn-sm btn-primary mr-1">Edit</router-link>
                                        <button @click.prevent="postDelete(post.id)"
                                        class="btn btn-sm btn-danger mr-1">Hapus</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
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

            let posts = ref([])
            onMounted(() => {
                axios.get('http://localhost/pegawai/public/api/pegawai')
                .then(respon => {
                    const res = respon.data;
                    const tmp  = {};

                    if (res.success == true){
                        const data = res.data;
                        data.forEach((item) => {
                            tmp [item.id]=item;
                        });
                    }
                    console.log(tmp)
                    posts.value = tmp;

                }).catch((error) => {
                    console.log(error.response.data);
                });
            });

            function postDelete(id) {
                axios
                .delete(`http://localhost/pegawai/public/api/pegawai/${id}`)
                .then((response)=>{
                    alert("Data Pegawai Dihapus!!!");
                    if(response.data.success == true){
                        delete posts.value[id];
                    }
                })
                .catch((error) => {
                    console.log(error.response.data);
                });
            }

            return {
                token,      // <-- state token
                user,       // <-- state user
                logout,      // <-- method logout
                posts,
                postDelete,
            }

        }

    }
</script>

<style>
.card {
    background: midnightblue;
}
.card-body, th, td {
    color: white;
}
.bg-orange {
    color:white;
    background: midnightblue;
    border-color: white;
}
</style>