import Vue from 'vue';
import moment from 'moment'

/**
 * 
 * Filter : capitalize
 *
 */

Vue.filter('capitalize', function (value) {
    if (!value) return ''
    value = value.toString()
    return value.charAt(0).toUpperCase() + value.slice(1)
  })

/**
 * 
 * Filter : Get URL Path
 *
 */

Vue.filter('urlToPath', function (url) {
    const parseURL = url.split( '/' );
	const urlPath = parseURL.splice(3).join('/');
	return '/'+urlPath;
  })


/**
 * 
 * Filter : Line break to <br>
 *
 */

Vue.filter('lb2br', function (str) {
    return str.replace(/(?:\r\n|\r|\n)/g, '<br>')
  })


/**
 * 
 * Filter : Is divisible by?
 *
 */

Vue.filter('divisibleBy', function (number, divsible) {
    if(number % divsible === 0){
      return true;
    } 
    return false;
  })

/**
 * 
 * Filter : Format Date
 *
 */

Vue.filter('formatDate', function(value) {
  if (value) {
    return moment(String(value)).format('DD—MM—YYYY')
  }
})