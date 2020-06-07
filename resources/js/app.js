/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import {
    Form,
    HasError,
    AlertError
}
from 'vform';
import VueRouter from 'vue-router'
import VueProgressBar from 'vue-progressbar'
import Swal from 'sweetalert2'

window.Vue = require('vue');
window.Form = Form;
window.Swal = Swal;

Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

Vue.use(VueRouter)
Vue.use(VueProgressBar, {
    color: 'rgb(143, 255, 199)',
    failedColor: 'red',
    height: '3px'
})

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})

window.Toast = Toast;


let routes = [{
        path: '/dashboard',
        component: require('./components/Dashboard.vue').default
    },
    {
        path: '/pelanggan',
        component: require('./components/Pelanggan.vue').default
    },
    {
        path: '/pembacaan-meteran',
        component: require('./components/PembacaanMeteran.vue').default
    },
    {
        path: '/tagihan',
        component: require('./components/Tagihan.vue').default
    },
    {
        path: '/pembayaran',
        component: require('./components/Pembayaran.vue').default
    },
    {
        path: '/pengaturan',
        component: require('./components/Pengaturan.vue').default
    },
]

const router = new VueRouter({
    mode: 'history', //membuat mode history
    routes // short for `routes: routes`
})

const app = new Vue({
    el: '#app',
    router
});
