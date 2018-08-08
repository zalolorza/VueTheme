
# VueTheme - Vue.js Boilerplate Theme for Wordpress
WordPress boilerplate theme using [WP REST API](https://developer.wordpress.org/rest-api/), [VueJs 2](http://vuejs.org), [Vue Ruter](https://router.vuejs.org/) and [Vuex](https://vuex.vuejs.org/). Inspired on [rtCamp](https://github.com/rtCamp/VueTheme)'s solution.

## Directory structure
```
/admin -> `Admin and Editor css`
/php -> WordPress configuration
  /lib -> PHP Classes 
/src -> Webpack source folder
  /assets 
  /components -> Vue Components
  /sass -> Sass Files
      /resources -> Sass resources
axios.js  -> Axios config
filters.js  -> Vue Filters
main.js  -> Entry point
router.js  -> Vue Router config
store.js  -> Vuex store config
```

## Router
The following elements are automated and exposed to Vue Router:
* Posts singles -> PostSingle.vue 
* CPT Singles -> CptnameSingle.vue
* Pages -> Page.vue
* Pages with template -> PageTemplateName.vue. Since we are not using php templates, page templates are set in config/config.ini

Other components must be set in router.php

## Installation
1. This is a regular WP theme. Install it from the admin.
2. Add `define( 'VUE_DEV', true );` in `wp-config.php` to get asset files from webpack dev server.
3. To start dev server with hot reload `npm run dev`. You will need also a PHP server. See webpack.config.js
5. To create build for production with minification `npm run build` and set `define( 'VUE_DEV', false );`

## Next
* Expose Achives, Categories, tags to Vue Router.
* Automatic edit of SCRIPTS_VERSION in config.init each time we `npm run build`
