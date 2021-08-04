import { createRouter, createWebHistory } from 'vue-router'

const routes = [
    {
        path: '/',
        name: 'login',
        component: () => import('@/views/auth/Login.vue')
    },
    {
        path: '/register',
        name: 'register',
        component: () => import('@/views/auth/Register.vue')
    },
    {
        path: '/dashboard',
        name: 'dashboard',
        component: () => import('@/views/dashboard/Index.vue')
    },
    {
        path: '/edit/:id',
        name: 'edit',
        component: () => import('@/views/dashboard/Edit.vue')
    },
    {
        path: '/pegawai',
        name: 'pegawai',
        component: () => import('@/views/dashboard/Pegawai.vue')
    },
    {
        path: '/tambahpegawai',
        name: 'tambah',
        component: () => import('@/views/dashboard/Tambah.vue')
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router