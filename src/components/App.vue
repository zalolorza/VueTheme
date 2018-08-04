<template>
	<div id="app">
		<transition v-bind:css="false" v-on:enter="enterRoute" v-on:leave="leaveRoute" name="transition-router" mode="out-in">
			<router-view />
		</transition>
	</div>
</template>


<script>

import { mapGetters } from 'vuex';

export default {

    data(){
		return {
			
		}
	},

	created () {
		document.addEventListener('click', this.documentClick);
	},

	mounted(){
		this.appLoaded = true;
	},

	destroyed () {
		document.removeEventListener('click', this.documentClick)
	},

	computed: {
		...mapGetters({
			
	 	}),
	},

	watch:{
		$route (to, from){

		
		}
	},
	
	methods:{

		documentClick(e){
			
		},
		
		enterRoute(el,done){

			done();

		},

		leaveRoute(el,done){

			done();

		}
	} 

}
</script>