import './sass/main.scss';


/**
 * 
 * Components and APP
 *
 */

import Vue from 'vue';
import './axios'
import './filters'
import router from './router'
import store from './store'
import App from './components/App.vue'


/**
 * 
 * APP
 *
 */

new Vue({
	el: '#app',
	render: h => h(App),
	store,
	router
});


