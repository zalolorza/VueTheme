import Vue from 'vue';
import Vuex from 'vuex';
import http from'./axios';

Vue.use( Vuex );

//Define vuex store
const store = new Vuex.Store( {
	state: {
		title: '',
		menus: {},
		vwp
	},
	getters: {
		getMenu: (state) => (menu) =>  {
		
			if(typeof state.menus[menu] == 'undefined') {
				return {}
			} 
			return state.menus[menu];
		},

		getMenus: state => state.menus,

		vwp: state => state.vwp
	},
	actions: {
		loadMenu : ({commit, state}, menu) => {
			if(typeof state.menus[menu] != 'undefined'){
				return;
			};

			if(typeof wpmenus[menu] != 'undefined'){
				commit('updateMenu',[menu, wpmenus[menu]])
			} else {
				http.get( 'wp-api-menus/v2/menu-locations/'+menu )
				.then( ( res ) => {
					commit('updateMenu',[menu, res.data])
				} );
			}
		},
	},
	mutations: {
		changeTitle( state, value ) {
			state.title = value;
			document.title = ( state.title ? state.title + ' - ' : '' ) + vwp.site_name;
		},
		
		updateMenu(state, value){
			Vue.set(state.menus,value[0],value[1]);	
		}
	}
} );

export default store;