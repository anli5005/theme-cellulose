<?php

function tcellulose_enqueue_styles() {
	wp_enqueue_style( "roboto", "//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic" );
	wp_enqueue_style( "material-icons", "//fonts.googleapis.com/icon?family=Material+Icons" );
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

function tcellulose_header_expanded() {
	return ( is_front_page() || is_page() || is_archive() || is_home() );
}

function tcellulose_add_body_classes( $classes ) {
	if ( tcellulose_header_expanded() ) {
		$classes[] = "expanded-header";
	}
	return $classes;
}

function tcellulose_register_widget_areas() {
	register_sidebar( array(
		'name' => __( 'Sidebar', 'tcellulose' ),
		'id' => 'tcellulose-sidebar',
		'description' => __( 'The widget area for the theme sidebar', 'tcellulose' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h5 class="widget-title">',
		'after_title' => '</h5>'
	) );

	register_sidebar( array(
		'name' => __( 'Footer', 'tcellulose' ),
		'id' => 'tcellulose-footer',
		'description' => __( 'The widget area for the theme footer', 'tcellulose' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h5 class="widget-title">',
		'after_title' => '</h5>'
	) );
}

function tcellulose_add_theme_support() {
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form' ) );
}

add_action( "wp_enqueue_scripts", "tcellulose_enqueue_styles" );
add_action( "wp_enqueue_scripts", "tcellulose_enqueue_script" );

add_action( "after_setup_theme", "tcellulose_register_menus" );
add_action( "after_setup_theme", "tcellulose_add_theme_support" );

add_action( "widgets_init", 'tcellulose_register_widget_areas' );

add_filter( "wp_page_menu", "tcellulose_page_menu_filter", 10, 1 );

add_filter( "body_class", "tcellulose_add_body_classes", 10, 1 );

?>
