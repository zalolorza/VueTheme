<?php

/**
 * 
 * Edit default WP image sizes
 *
 */

function update_default_thumbnails(){

    update_option( 'thumbnail_size_w', 160 );
    update_option( 'thumbnail_size_h', 160 );
    update_option( 'thumbnail_crop', 1 );
    
    update_option( 'medium_size_w', 400 );
    update_option( 'medium_size_h', 300 );
    update_option( 'medium_crop', 0 );
    
    update_option( 'large_size_w', 600 );
    update_option( 'large_size_h', 400 );
    update_option( 'large_crop', 0 );

}

add_action( 'after_switch_theme', 'update_default_thumbnails' );


/**
 * 
 * Add custom image sizes
 *
 */

function set_custom_thumbnails(){

    add_image_size( 'medium_2x', 800, 600, false );
    add_image_size( 'large_2x', 1200, 800, false );

}

add_action( 'after_setup_theme', 'set_custom_thumbnails' );



/**
 * 
 *  JPEG Quality
 *
 */

function custom_jpeg_quality( $quality, $context ) {
	return 100;
}
add_filter( 'jpeg_quality', 'custom_jpeg_quality', 10, 2 );