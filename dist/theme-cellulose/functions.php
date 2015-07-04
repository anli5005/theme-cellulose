<?php

function tcellulose_enqueue_styles() {
	wp_enqueue_style( "roboto", "https://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic" );
	wp_enqueue_style( "material-icons", "https://fonts.googleapis.com/icon?family=Material+Icons" );
	wp_enqueue_style( "cellulose-styles", get_stylesheet_uri() );
}

function tcellulose_enqueue_script() {
	wp_enqueue_script( "jquery" );
	wp_enqueue_script( "cellulose-js", get_template_directory_uri() . "/js/scripts.min.js", array( "jquery" ) );
}

function tcellulose_register_menus() {
	register_nav_menu( "navigation", __( "Navigation", "tcellulose" ) );
}

function tcellulose_navigation_fallback( $args ) {
	$args[ "show_home" ] = 1;
	wp_page_menu( $args );
}

function tcellulose_page_menu_filter( $menu ) {
	return preg_replace( "/<(div[^>]*|\/div)>\n?/i", "", $menu );
}

add_action( "wp_enqueue_scripts", "tcellulose_enqueue_styles" );
add_action( "wp_enqueue_scripts", "tcellulose_enqueue_script" );

add_action( "after_setup_theme", "tcellulose_register_menus" );

add_filter( "wp_page_menu", "tcellulose_page_menu_filter", 10, 1 );

?>