
# VueTheme - Vue.js Boilerplate Theme for Wordpress
WordPress theme using WP REST API and [VueJs 2](http://vuejs.org), inspired on [rtCamp](https://rtcamp.com)'s solution. 
WP Router is exposing to Vue Router. Only CPT and pages.
This theme is base theme for WordPress theme developers.

## How to use it for development?
1. Go to your WP theme directory & navigate to VueTheme.
2. Install dependencies `npm install`
3. Make sure you add `define( 'VUE_DEV', true );` in `wp-config.php` to get asset files from webpack dev server.
4. To start dev server with hot reload `npm run dev`
5. To create build for production with minification `npm run build` and set   `define( 'VUE_DEV', false );`

## Frameworks / Packages used
* [Vue 2](http://vuejs.org)
* [Vue-Router](https://github.com/vuejs/vue-router)
* [Vuex](https://github.com/vuejs/vuex)
* [Axios](https://github.com/mzabriskie/axios)
* [Babel](https://babeljs.io)
* [Webpack](https://webpack.js.org/)
