<?php


/**
 *
 * Basic theme setup
 *
 */

function theme_setup() {

    // Add post-thumbnails
	add_theme_support( 'post-thumbnails' );

}

add_action( 'after_setup_theme', 'theme_setup' );