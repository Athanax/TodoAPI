import Vue from 'vue';
import Axios from 'axios';

import VueRouter from 'vue-router';

import Form from './core/Form';

// this is to tell vue that we are using the vue router in client side routing

window.Vue = Vue;
Vue.use(VueRouter);

window.Axios = Axios;


window.Axios.defaults.headers.common={
    'X-Requested-With':'XMLHttpRequest'
};

window.Form = Form;
// alert();
