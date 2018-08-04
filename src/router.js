import Vue from 'vue';
import VueRouter from 'vue-router'
Vue.use(VueRouter);


/**
 * 
 * Import all vue components async
 *
 */

const Page = () => import('./components/Page.vue');
Vue.component( 'Page', Page );

const PageHome = () => import('./components/PageHome.vue');
Vue.component( 'PageHome', PageHome );

const News = () => import('./components/News.vue');
Vue.component( 'News', News );

const ErrorPage = () => import('./components/Error.vue');
Vue.component( 'ErrorPage', ErrorPage );



/**
 * 
 * Set Router
 *
 */

const router = new VueRouter( {
  mode: 'history',
  scrollBehavior (to, from, savedPosition) {
    return { x: 0, y: 0 };  // scroll to top on-router-link click
  },
	routes: []
} );



/**
 * 
 * Add WP Routes to Vue Router
 *
 */

for(const key in wprouter){
    wprouter[key].component = Vue.component(wprouter[key].component);
    if(typeof wprouter[key].component == 'undefined'){
      wprouter[key].component = Vue.component('ErrorPage');
      wprouter[key].componentName = 'ErrorPage';
    }
    wprouter[key].props = {
      default: true,
      wproute :  Object.assign({}, wprouter[key])
    }
};

router.addRoutes( wprouter );



/**
 * 
 * Export Router
 *
 */


export default router;
