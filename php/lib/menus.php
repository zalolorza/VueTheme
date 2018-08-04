<?php


include_once ('cache.php');

class Menus {


    function __construct($menus) {

        $this->menus = $menus;

        $this->register();

        return $this;

    }

    private function register(){

        if ( function_exists( 'register_nav_menus' ) ) {

            register_nav_menus(
                $this->menus
            );
        
        };

        return $this;
        
    }


    public function expose_js($script, $var_name){

        add_action( 'wp_enqueue_scripts', function() use ($script, $var_name){

            wp_localize_script( $script, $var_name, $this->get_all());

        } );

    }


    public function get_all(){

        $menus = VueThemeCache::getCache('menus');

       
	    if(!$menus) {
            $menus = array();
            foreach($this->menus as $key => $menu){
                $menus[$key] = $this->get_menu($key);
            }
            VueThemeCache::saveCache('menus', $menus, array('flush_on_save'=>array('nav_menu_item')));
        }
        

        return $menus;

    }

    public function get_menu($menu = 'main'){

            if(is_object($menu)){

                $menu_name=$menu->get_param( 'name' );

            } else {

                $menu_name = $menu;
            }


            $locations = get_nav_menu_locations();
                $menu_id = $locations[ $menu_name ];

                $items = wp_get_nav_menu_items($menu_id);

                if(!$items) return false;
                
                foreach($items as &$item){

                    
                    $newItem = (array) $item;


                    $newItem['ID'] = $item->ID;
                    $newItem['id'] = $item->ID;
                    $newItem['title'] = $item->title;
                    $newItem['url'] = $item->url;
                    $classes = '';


                    foreach($item->classes as $class){
                        $classes = $class.' ';
                    }

                    if(get_the_ID() == $item->object_id || wp_get_post_parent_id(get_the_ID()) == $item->object_id) {
                        $classes .= ' selected ';
                    }
                    $newItem['classes'] = $classes;
                    $newItem['target'] = $item->target;
                    if(!$newItem['target']){
                        $newItem['target'] ='_self';
                    }
                    $item = $newItem;
                }

            return $items;

        }

}
