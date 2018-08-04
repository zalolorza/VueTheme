<?php

include_once('lib/page-templater.php');

/**
 * 
 * Init custom Page Templates
 *
 */

PageTemplater::init(PAGE_TEMPLATES);


/**
 * 
 * Hide editor on specific pages.
 *
 */
add_action( 'admin_init', 'hide_editor' );

function hide_editor() {
    // Get the Post ID.
    $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
    if( !isset( $post_id ) ) return;
    // Hide the editor on a page with a specific page template
    // Get the name of the Page Template file.
    $template_file = get_post_meta($post_id, '_wp_page_template', true);

    if(in_array($template_file, array('home','gallery','news'))){ // the filename of the page template
      remove_post_type_support('page', 'editor');
    }

}