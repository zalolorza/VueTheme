<?php


/**
* Deregister scripts
*/

function v_deregister_scripts(){
    wp_deregister_script( 'wp-embed' );
  }
add_action( 'wp_footer', 'v_deregister_scripts' );
remove_action( 'wp_head', 'print_emoji_detection_script', 7 ); 
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' ); 
remove_action( 'wp_print_styles', 'print_emoji_styles' ); 
remove_action( 'admin_print_styles', 'print_emoji_styles' );


/**
* Dequeue jQuery script in WordPress.
*/
function v_jquery_deregister() {
   wp_deregister_script('jquery');
}
if (!is_admin()) add_action("wp_enqueue_scripts", "v_jquery_deregister", 11);


/**
* Register scripts
*/


function v_register_theme_scripts() {

    if ( defined( 'VUE_DEV' ) && VUE_DEV ) {
        
        $build_root = 'http://localhost:8080';

    } else {

        $build_root = get_template_directory_uri();
    }

    wp_enqueue_script( 'custom-ease', get_template_directory_uri() . '/src/vendor/greensock/easing/CustomEase.js', null, '1.0.0', true );
    wp_enqueue_script( 'rest-theme-vue', $build_root . '/dist/build.js', array(), SCRIPTS_VERSION, true );
    wp_enqueue_style( 'style',  $build_root . '/dist/build.css', array(), SCRIPTS_VERSION);

    $base_url  = esc_url_raw( home_url() );
    $base_path = rtrim( parse_url( $base_url, PHP_URL_PATH ), '/' );


    if(!defined('ICL_LANGUAGE_CODE')){
        define(ICL_LANGUAGE_CODE, false);
    };
    
    wp_localize_script( 'rest-theme-vue', 'vwp', array(
        'root'      => esc_url_raw( rest_url() ),
        'base_url'  => $base_url,
        'base_path' => $base_path ? $base_path . '/' : '/',
        'site_url'  => site_url(),
        'nonce'     => wp_create_nonce( 'wp_rest' ),
        'site_name' => get_bloginfo( 'name' ),
        'front_page_id' => get_option( 'page_on_front' ),
        'lang' => ICL_LANGUAGE_CODE,
        'lang_switch' => array_values(icl_get_languages('')),
        'stylesheet_directory_uri' => get_stylesheet_directory_uri()
    ) );

    wp_localize_script( 'rest-theme-vue', 'vwp_options', array(
        'address'      => get_field('address', 'option'),
        'timetable'      => get_field('timetable', 'option')
    ) );
}

add_action( 'wp_enqueue_scripts', 'v_register_theme_scripts' );





