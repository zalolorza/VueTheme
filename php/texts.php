<?php


/**
*   Remove wpautop
*/

remove_filter ('the_content', 'wpautop');
add_filter( 'the_content', 'nl2br' );

function acf_wysiwyg_remove_wpautop() {
    remove_filter('acf_the_content', 'wpautop' );
    add_filter( 'acf_the_content', 'nl2br' );
}

add_action('acf/init', 'acf_wysiwyg_remove_wpautop');


/**
*   Polyfill for wp_title()
*/

add_filter( 'wp_title','vue_title', 10, 3 );

function vue_title( $title, $sep, $seplocation ) {

	if ( false !== strpos( $title, __( 'Page not found' ) ) ) {

		$replacement = ucwords( str_replace( '/', ' ', $_SERVER['REQUEST_URI'] ) );
		$title       = str_replace( __( 'Page not found' ), $replacement, $title );

	}

	return $title;
}


