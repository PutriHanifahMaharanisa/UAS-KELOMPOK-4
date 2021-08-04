<template>
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        MAIN MENU
                        <hr>
                        <ul class="list-group">
                            <router-link :to="{name: 'pegawai'}" class="list-group-item bg-orange text-decoration-none">
                                DATA PEGAWAI
                            </router-link>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        TAMBAH DATA PEGAWAI
                        <hr>
                        <form @submit.prevent="store">
                            <div class="form-group">
                                <label for="nip" class="front-weight-bold">NIP</label>
                                <input type="text" class="form-control" v-model="post.nip" placeholder="NIP">
                                <div v-if="validation.nip" class="mt-2 alert alert-danger">
                                    {{ validation.nip[0] }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="nama" class="front-weight-bold">Nama Lengkap</label>
                                <input type="text" class="form-control" v-model="post.nama" placeholder="Nama Lengkap">
                                <div v-if="validation.nama" class="mt-2 alert alert-danger">
                                    {{ validation.nama[0] }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="jk" class="front-weight-bold">Jenis Kelamin</label>
                                <select class="form-control" v-model="post.jk">
                                    <option value="" disabled hidden>Jenis Kelamin</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                                <div v-if="validation.jk" class="mt-2 alert alert-danger">
                                    {{ validation.jk[0] }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="tempat_lahir" class="front-weight-bold">Tempat Lahir</label>
                                <input type="text" class="form-control" v-model="post.tempat_lahir">
                                <div v-if="validation.tempat_lahir" class="mt-2 alert alert-danger">
                                    {{ validation.tempat_lahir[0] }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="tgl_lahir" class="front-weight-bold">Tanggal Lahir</label>
                                <input type="date" class="form-control" v-model="post.tgl_lahir">
                                <div v-if="validation.tgl_lahir" class="mt-2 alert alert-danger">
                                    {{ validation.tgl_lahir[0] }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="alamat" class="front-weight-bold">Alamat</label>
                                <textarea class="form-control none-resize" rows="4" placeholder="Alamat" v-model="post.alamat"></textarea>
                                <div v-if="validation.alamat" class="mt-2 alert alert-danger">
                                    {{ validation.alamat[0] }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="front-weight-bold">Email</label>
                                <input type="email" class="form-control" v-model="post.email">
                                <div v-if="validation.email" class="mt-2 alert alert-danger">
                                    {{ validation.email[0] }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="no_telp" class="front-weight-bold">No Telp</label>
                                <input type="number" class="form-control" v-model="post.no_telp">
                                <div v-if="validation.no_telp" class="mt-2 alert alert-danger">
                                    {{ validation.no_telp[0] }}
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import {reactive, ref, onMounted} from "vue";
import {useRouter, useRoute} from "vue-router";
import axios from 'axios'

    export default {

        setup() {
            const post = reactive({
            nip: '',
            nama: '',
            jk: '',
            alamat: '',
            tempat_lahir: '',
            tgl_lahir: '',
            email: '',
            no_telp: ''
            })

            const validation = ref([]);
            const route = useRoute();
            const router = useRouter();

            onMounted(() => {
                axios.get(`http://localhost/pegawai/public/api/pegawai/${route.params.id}`)
                .then(response => {
                    post.nip = response.data.data.nip
                    post.nama = response.data.data.nama
                    post.jk = response.data.data.jk
                    post.alamat = response.data.data.alamat
                    post.tempat_lahir = response.data.data.tempat_lahir
                    post.tgl_lahir = response.data.data.tgl_lahir
                    post.email = response.data.data.email
                    post.no_telp = response.data.data.no_telp
                }).catch(error => {
                    console.log(error.response.data)
                })
            })

            function store(){
                let nip = post.nip
                let nama = post.nama
                let jk = post.jk
                let alamat = post.alamat
                let tempat_lahir = post.tempat_lahir
                let tgl_lahir = post.tgl_lahir
                let email = post.email
                let no_telp = post.no_telp

                axios.post("http://localhost/pegawai/public/api/pegawai", {
                    nip: nip,
                    nama: nama,
                    jk: jk,
                    alamat: alamat,
                    tempat_lahir: tempat_lahir,
                    tgl_lahir: tgl_lahir,
                    email: email,
                    no_telp: no_telp
                }).then(() => {
                    router.push({
                        name: 'pegawai'
                    })
                }).catch(error => {
                    validation.value = error.response.data
                })
            }

            return {
                post,
                validation,
                router,
                store
            }

        }

    }
</script>
<style>
.none-resize {
    resize: none;
}
.card {
    background: midnightblue;
}
.card-body {
    color: white;
}
.bg-orange {
    color:white;
    background: midnightblue;
    border-color: white;
}
</style>