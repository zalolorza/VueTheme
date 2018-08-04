<?php

/**
 *
 * Remove default taxonomies
 *
 */

add_action( 'init', 'v_unregister_taxonomy');
 
function v_unregister_taxonomy(){
        global $wp_taxonomies;
        $taxonomies = array( 'category', 'post_tag' );
        foreach( $taxonomies as $taxonomy ) {
        if ( taxonomy_exists( $taxonomy) )
        unset( $wp_taxonomies[$taxonomy]);
        }
}


/**
 *
 * Remove default post type
 *
 */

add_action( 'admin_menu', 'remove_default_post_type' );

function remove_default_post_type() {
    remove_menu_page( 'edit.php' );
}

add_action( 'admin_bar_menu', 'remove_default_post_type_menu_bar', 999 );

function remove_default_post_type_menu_bar( $wp_admin_bar ) {
    $wp_admin_bar->remove_node( 'new-post' );
}

add_action( 'wp_dashboard_setup', 'remove_draft_widget', 999 );

function remove_draft_widget(){
    remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
}





/**
 * 
 * Register a custom post types.
 *
 */

add_action( 'init', 'register_news' );

function register_news() {
	$labels = array(
		'name'               => _x( 'Notícies', 'post type general name', 'pur' ),
		'singular_name'      => _x( 'Notícia', 'post type singular name', 'pur' ),
		'menu_name'          => _x( 'Notícies PUR', 'admin menu', 'pur' ),
		'name_admin_bar'     => _x( 'Notícia', 'add new on admin bar', 'pur' ),
		'add_new'            => _x( 'Afegir nova', 'book', 'pur' ),
		'add_new_item'       => __( 'Afegir nova notícia', 'pur' ),
		'new_item'           => __( 'Nova notícia', 'pur' ),
		'edit_item'          => __( 'Editar notícia', 'pur' ),
		'view_item'          => __( 'Veure notícia', 'pur' ),
		'all_items'          => __( 'Totes les notícies', 'pur' ),
		'search_items'       => __( 'Cercar notícies', 'pur' ),
		'parent_item_colon'  => __( 'Notícies mare:', 'pur' ),
		'not_found'          => __( 'Cap notícia trobada', 'pur' ),
		'not_found_in_trash' => __( 'Cap notícia trobada a la paperera.', 'pur' )
	);

	$args = array(
		'labels'             => $labels,
        'description'        => __( 'Description', 'pur' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
        'query_var'          => true,
		'rewrite'            => array( 'slug' => 'news' ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail' ),
		'show_in_rest'       => true,
  		'rest_base'          => 'news',
  		'rest_controller_class' => 'WP_REST_Posts_Controller',
	);

    register_post_type( 'news-pur', $args );
    

}