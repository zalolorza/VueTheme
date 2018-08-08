
# VueTheme - Vue.js Boilerplate Theme for Wordpress
WordPress boilerplate theme using WP REST API and [VueJs 2](http://vuejs.org), inspired on [rtCamp](https://github.com/rtCamp/VueTheme)'s solution. 

## Router
The following elements are automated and exposed to Vue Router:
* Posts singles -> PostSingle.vue 
* CPT Singles -> CptnameSingle.vue
* Pages -> Page.vue
* Pages with template -> PageTemplateName.vue

## Installation
1. This is a regular WP theme. Install it from the admin.
2. Install dependencies `npm install`
3. Add `define( 'VUE_DEV', true );` in `wp-config.php` to get asset files from webpack dev server.
4. To start dev server with hot reload `npm run dev`
5. To create build for production with minification `npm run build` and set `define( 'VUE_DEV', false );`

# Next
* Expose Achives, Categories, tags to Vue Router.
