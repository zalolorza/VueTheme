import Vue from 'vue';
import axios from 'axios';

const http = axios.create( {
	baseURL: vwp.base_url+'/wp-json/'
} );


Vue.prototype.$http = http;


export default http;
