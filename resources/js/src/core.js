/**
 * 
 * Mendeskripsikan element javascript yang dibutuhkan
 * 
 */

require('./bootstrap');

window.Vue = require('vue');

// Register vendor Components
import './vendor.js'

// Membuat fitur auto update
window.Update = new Vue();

/**
 * 
 * memberitahukan sistem untuk menggunakan Vue Router
 * 
 */

import VueRouter from 'vue-router'

Vue.use(VueRouter)

/**
 * 
 * Meregristrasikan Vue Router
 * 
 */

let routes = [{
        path: '/dashboard',
        component: require('./admin/Dashboard.vue').default
    },
    {
        path: '/pelanggan',
        component: require('./admin/Pelanggan.vue').default
    },
    {
        path: '/pembacaan-meteran',
        component: require('./admin/PembacaanMeteran.vue').default
    },
    {
        path: '/tagihan',
        component: require('./admin/Tagihan.vue').default
    },
    {
        path: '/pembayaran',
        component: require('./admin/Pembayaran.vue').default
    },
    {
        path: '/pengaturan',
        component: require('./admin/Pengaturan.vue').default
    },
]

/**
 * 
 * Meneruskan router untuk dapat ditampilkan ke layout
 * 
 */

const router = new VueRouter({
    mode: 'history', //membuat mode history
    routes // short for `routes: routes`
})

/**
 * 
 * Membuat Applikasi Vue dan Menghubungkan ke laravel
 * 
 */

const app = new Vue({
    el: '#app',
    router
});
