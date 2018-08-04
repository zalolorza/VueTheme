<?php

include_once 'lib/wp-api-menus-v2.php';

apply_filters( 'rocket_cache_reject_wp_rest_api', false );

if ( ! function_exists ( 'wp_rest_menus_init' ) ) :

	/**
	 * Init JSON REST API Menu routes.
	 *
	 * @since 1.0.0
	 */
	function wp_rest_menus_init() {

        if ( ! defined( 'JSON_API_VERSION' ) && ! in_array( 'json-rest-api/plugin.php', get_option( 'active_plugins' ) ) ) {
			$class = new WP_REST_Menus();
			 add_filter( 'rest_api_init', array( $class, 'register_routes' ) );
		}
	}

	add_action( 'init', 'wp_rest_menus_init' );

endif;



// Extend rest response
add_action( 'rest_api_init', 'extend_rest_post_response' );

function extend_rest_post_response() {

	// Add featured image
	register_rest_field( 'page',
		'featured_image_src', //NAME OF THE NEW FIELD TO BE ADDED - you can call this anything
		array(
			'get_callback'    => 'v_get_image_src',
			'update_callback' => null,
			'schema'          => null,
			 )
	);


	register_rest_field( 'news-pur',
		'featured_image_src', //NAME OF THE NEW FIELD TO BE ADDED - you can call this anything
		array(
			'get_callback'    => 'v_get_image_src',
			'update_callback' => null,
			'schema'          => null,
			)
	);
	

	register_rest_field( 'news-impur',
		'featured_image_src', //NAME OF THE NEW FIELD TO BE ADDED - you can call this anything
		array(
			'get_callback'    => 'v_get_image_src',
			'update_callback' => null,
			'schema'          => null,
			)
	);


}



// Get featured image
function v_get_image_src( $object, $field_name, $request ) {

	$feat_img_array['large_2x'] = wp_get_attachment_image_src( $object['featured_media'], 'large_2x', false );
	$feat_img_array['medium_2x'] = wp_get_attachment_image_src( $object['featured_media'], 'medium_2x', false );
	$feat_img_array['large'] = wp_get_attachment_image_src( $object['featured_media'], 'large', false );
	$feat_img_array['medium'] = wp_get_attachment_image_src( $object['featured_media'], 'medium', false );
	
	$image = is_array( $feat_img_array ) ? $feat_img_array : 'false';
	return $image;

}
