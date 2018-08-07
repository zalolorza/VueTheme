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
		'name'               => _x( 'News Vue', 'post type general name', 'VueTheme' ),
		'singular_name'      => _x( 'News', 'post type singular name', 'VueTheme' ),
		'menu_name'          => _x( 'News Vue', 'admin menu', 'VueTheme' ),
		'name_admin_bar'     => _x( 'News', 'add new on admin bar', 'VueTheme' ),
		'add_new'            => _x( 'Add news', 'book', 'VueTheme' ),
		'add_new_item'       => __( 'Add new news', 'VueTheme' ),
		'new_item'           => __( 'New news', 'VueTheme' ),
		'edit_item'          => __( 'Edit news', 'VueTheme' ),
		'view_item'          => __( 'See news', 'VueTheme' ),
		'all_items'          => __( 'All news', 'VueTheme' ),
		'search_items'       => __( 'Search news', 'VueTheme' ),
		'parent_item_colon'  => __( 'Parent news:', 'VueTheme' ),
		'not_found'          => __( 'No news found', 'VueTheme' ),
		'not_found_in_trash' => __( 'No news found in trash', 'VueTheme' )
	);

	$args = array(
		'labels'             => $labels,
        'description'        => __( 'Description', 'VueTheme' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
        'query_var'          => true,
		'rewrite'            => array( 'slug' => 'news-vue' ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail' ),
		'show_in_rest'       => true,
  		'rest_base'          => 'news-vue',
  		'rest_controller_class' => 'WP_REST_Posts_Controller',
	);

    register_post_type( 'news-vue', $args );
    

}