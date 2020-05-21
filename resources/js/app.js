import axios from 'axios'
import Vue from 'vue'
import VueAuth from '@websanova/vue-auth'
import VueAxios from 'vue-axios'
import VueRouter from 'vue-router'
import App from './components/App'
import router from './plugins/router'
import store from './store/index'

import auth from './plugins/auth'

// import pagination from 'laravel-vue-pagination'

Vue.component('pagination', require('laravel-vue-pagination'));
window.Vue = Vue;
Vue.router = router;
Vue.use(VueRouter);

Vue.use(VueAxios, axios);
Vue.use(VueAuth, auth)
Vue.component('app', App);
// Vue.component(pagination);

const app = new Vue({
    store,
    router,
    el: '#app',
});
