<?php

/**
* 	Add options page
*/

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'General options',
		'menu_title'	=> 'General options',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	
}


/**
* 	Set default language options page
*/

if(defined('ICL_LANGUAGE_CODE')){
		add_filter('acf/settings/default_language', 'my_acf_settings_default_language');
		
		function my_acf_settings_default_language( $language ) {
		
			return 'en';
			
		}

		add_filter('acf/settings/current_language', 'my_acf_settings_current_language');
		
		function my_acf_settings_current_language( $language ) {
		
			return ICL_LANGUAGE_CODE;
			
		}
}



/**
* 	Load 'gallery' field from default language
*/

if(function_exists('icl_object_id')){
	add_filter( 'acf/rest_api/page/get_fields', 'update_gallery');
	add_filter( 'acf/rest_api/news-impur/get_fields', 'update_gallery');
	add_filter( 'acf/rest_api/news-pur/get_fields', 'update_gallery');

	function update_gallery($data){
		global $post;
		$translation = icl_object_id($post->ID, $post->post_type, true,'en');
		global $sitepress;
		$current_language = $sitepress->get_current_language();
		$default_language = $sitepress->get_default_language();
		$sitepress->switch_lang($default_language);
		$gallery = get_field('gallery', $translation);
		$sitepress->switch_lang($current_language);
		$imagesCount = count($images);
		$data['acf']['gallery'] = $gallery;
		
		return $data;
	}
}