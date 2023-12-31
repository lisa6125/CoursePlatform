require('./bootstrap');
import 'bootstrap';

import Vue from 'vue';

import '@fortawesome/fontawesome-free/css/all.css';
import '@fortawesome/fontawesome-free/js/all.js';

import router from './routes';
import store from './store/index.js'
import Layout from './vue/view/Layout.vue';

import swalPlugin from './plugins/VueSweetalert2';
Vue.use(swalPlugin);

import "swiper/css/swiper.css";
import VueAwesomeSwiper from "vue-awesome-swiper";
Vue.use(VueAwesomeSwiper);

import VueDatepickerLocal from "vue-datepicker-local";

const app = new Vue({
    el: '#app',
    store,
    components:{ Layout },
    router: router
});
