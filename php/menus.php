<?php

include_once ('lib/menus.php');

$menus = array(
	'main-menu' => __( 'Main Menu' ),
	'socials' => __( 'Social Networks' )
);

$menus = new Menus($menus);
$menus->expose_js('rest-theme-vue','wpmenus');


