/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';

import router from './router';

import 'bootstrap';

import {store} from './store/store';

import Navbar from './views/inc/navbar'

// import corousel from './views/Corousel'

window.onload = function(){
    new Vue({
        el: '#root',

        store: store,
    
        router: router,

        components:{
            Navbar
        },

        created(){
            // alert();
        }
        
    });
}