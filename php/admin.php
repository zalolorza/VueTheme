<?php

/**
*   No admin bar
*/
add_filter('show_admin_bar', '__return_false');



/**
*   No excerpt
*/
add_filter( 'excerpt_more', '__return_false' );


/**
* Admin editor styles
*/


function custom_editor_styles() {

	add_editor_style('admin/editor-styles.css');
}
 

add_filter('init', "custom_editor_styles");



function wpb_mce_buttons_2($buttons) {
    array_unshift($buttons, 'styleselect');
    return $buttons;
}
add_filter('mce_buttons_2', 'wpb_mce_buttons_2');



/*
* Callback function to filter the MCE settings
*/
 
function my_mce_before_init_insert_formats( $init_array ) {  
 
// Define the style_formats array
 
    $style_formats = array(  

        array(  
            'title' => 'Content Block',  
            'block' => 'span',  
            'classes' => 'content-block',
            'wrapper' => true,
             
        ),  
        array(  
            'title' => 'Blue Button',  
            'block' => 'span',  
            'classes' => 'blue-button',
            'wrapper' => true,
        ),
        array(  
            'title' => 'Red Button',  
            'block' => 'span',  
            'classes' => 'red-button',
            'wrapper' => true,
        ),
    );  
    // Insert the array, JSON ENCODED, into 'style_formats'
    $init_array['style_formats'] = json_encode( $style_formats );  
     
    return $init_array;  
   
} 
// Attach callback to 'tiny_mce_before_init' 
add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' );