<?php

include_once ('lib/cache.php');

/**
 *
 * Get the routes
 *
 */

function v_get_routes(){

	$cache = VueThemeCache::getCache('routes');

	if($cache) return $cache;
	

	$base_url  = esc_url_raw( apply_filters( 'wpml_home_url', get_option( 'home' ) ) );
	$base_path = rtrim( parse_url( $base_url, PHP_URL_PATH ), '/' );

		$routes = array();
		
		foreach(get_post_types(null, 'objects') as $cpt){
			if($cpt->public && $cpt->name != 'page' && $cpt->name != 'post' && $cpt->name != 'attachment'){
				if($cpt->rewrite['slug']){
					$slug = $cpt->rewrite['slug'];
				} else {
					$slug  = $cpt->name;
				}
				$component = str_replace(' ', '', ucwords(str_replace('-', ' ', $cpt->name))).'Single';
				
				$depth = count(explode('/', trim($slug, '/'))) + 1;  

				$routes[] = array(
					'type' => 'cpt',
					'depth' => $depth,
					'path' => $base_path.'/'.$slug.'/:slug/',
					'component' => $component,
					'componentName' => $component
				);

				
			}
		};

		
		foreach(get_pages() as $page) {
			$url = parse_url(get_permalink($page));
			$route = $url['path'];

			if($route == '/'){
				$depth = 0;
			} else {
				$path = trim($route, '/'); 
				$depth = count(explode('/', $path));  
			}

			$template = get_post_meta($page->ID,'_wp_page_template');
			
			if( !isset($template[0]) || $template[0] == 'default' ){
				$component = 'Page';
			} else {
				$component = 'Page'.ucwords($template[0]);
			}

			if($page->post_parent){
				$section = get_field('section',$page->post_parent);
			} else {
				$section = get_field('section',$page->ID);
			}

			if(!$section){
				$section = 'pur';
			}


			$routes[] = array(
				'type'=>'page',
				'id' => $page->ID,
				'depth' => $depth,
				'path' => $route,
				'component' => $component,
				'componentName' => $component,
				'section' => $section
			);

			
		}

		usort($routes, function($a, $b) {
			return $b['depth'] <=> $a['depth'];
		});


		VueThemeCache::saveCache('routes', $routes, array('flush_on_save'=>array('page')));

	
		return $routes;

}


/**
 *
 *  Expose routes
 *
 */

function v_register_routes(){

		wp_localize_script( 'rest-theme-vue', 'wprouter', v_get_routes());
}


add_action( 'wp_enqueue_scripts', 'v_register_routes' );

