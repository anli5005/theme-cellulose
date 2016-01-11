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

/* function tcellulose_header_expanded() {
	return ( is_front_page() || is_page() || is_archive() || is_home() );
} */

function tcellulose_add_body_classes( $classes ) {
	/* if ( tcellulose_header_expanded() ) {
		$classes[] = "expanded-header";
	} */
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
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );
}

function tcellulose_add_pagination_button_classes() {
	return 'class="waves-effect waves-light btn-floating"';
}

function tcellulose_comment_field_filter( $field ) {
	return preg_replace( '/<p class="([^"]*)">/', '<p class="$1 input-field">', preg_replace( '/<textarea ([^>]*)>/', '<textarea $1 class="materialize-textarea">', $field ) );
}

add_action( "wp_enqueue_scripts", "tcellulose_enqueue_styles" );
add_action( "wp_enqueue_scripts", "tcellulose_enqueue_script" );

add_action( "after_setup_theme", "tcellulose_register_menus"    );
add_action( "after_setup_theme", "tcellulose_add_theme_support" );

add_action( "widgets_init", 'tcellulose_register_widget_areas' );

add_filter( "wp_page_menu", "tcellulose_page_menu_filter", 10, 1 );

add_filter( "body_class", "tcellulose_add_body_classes", 10, 1 );

add_filter( 'next_posts_link_attributes',     'tcellulose_add_pagination_button_classes', 10, 1 );
add_filter( 'previous_posts_link_attributes', 'tcellulose_add_pagination_button_classes', 10, 1 );

add_filter( "comment_form_field_comment", "tcellulose_comment_field_filter", 10, 1 );
add_filter( "comment_form_field_author",  "tcellulose_comment_field_filter", 10, 1 );
add_filter( "comment_form_field_email",   "tcellulose_comment_field_filter", 10, 1 );
add_filter( "comment_form_field_url",     "tcellulose_comment_field_filter", 10, 1 );

// Color Manipulation Functions

function tcellulose_rgb_to_hex( $rgb ) {
	$hex = '#';
	foreach( $rgb as $element ) {
		$hex .= str_pad( strtoupper( dechex( $element ) ), 2, '0', STR_PAD_LEFT );
	}
	return $hex;
}
function tcellulose_hex_to_rgb( $hex ) {
	$trimmed = str_replace( '#', '', $hex );
	$rgb = array();
	for ($i = 0; $i < 3; $i++) {
		$element = substr( $trimmed, $i * 2, 2 );
		$rgb[] = hexdec( $element );
	}
	return $rgb;
}

function tcellulose_rgb_brightness( $color ) {
	return sqrt( ( 0.299 * pow( $color[0], 2 ) ) + ( 0.587 * pow( $color[1], 2 ) ) + ( 0.114 * pow( $color[2], 2 ) ) );
}

// Customizer functions

function tcellulose_customize_register( $wp_customize ) {
	$default_transport = 'refresh';

	// Colors
	$wp_customize->add_section( 'tcellulose_color_settings', array(
		'title'    => __( 'Colors', 'tcellulose' ),
		'priority' => 30
	) );
	// Primary Color
	$wp_customize->add_setting( 'tcellulose_primary_color', array(
		'default'  => '#2196F3',
		'transport' => $default_transport
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'tcellulose_primary_color', array(
		'label'    => __( 'Primary Color', 'tcellulose' ),
		'settings' => 'tcellulose_primary_color',
		'section'  => 'tcellulose_color_settings'
	) ) );
	// Accent Color
	$wp_customize->add_setting( 'tcellulose_accent_color', array(
		'default' => 'indigo',
		'transport' => $default_transport
	) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'tcellulose_accent_color', array(
		'label'    => __( 'Accent Color', 'tcellulose' ),
		'settings' => 'tcellulose_accent_color',
		'section'  => 'tcellulose_color_settings',
		'type'     => 'select',
		'choices'  => array(
			'red'         => __( 'Red', 'tcellulose' ),
			'pink'        => __( 'Pink', 'tcellulose' ),
			'purple'      => __( 'Purple', 'tcellulose' ),
			'deep-purple' => __( 'Deep Purple', 'tcellulose' ),
			'indigo'      => __( 'Indigo', 'tcellulose' ),
			'blue'        => __( 'Blue', 'tcellulose' ),
			'light-blue'  => __( 'Light Blue', 'tcellulose' ),
			'cyan'        => __( 'Cyan', 'tcellulose' ),
			'teal'        => __( 'Teal', 'tcellulose' ),
			'green'       => __( 'Green', 'tcellulose' ),
			'light-green' => __( 'Light Green', 'tcellulose' ),
			'lime'        => __( 'Lime', 'tcellulose' ),
			'yellow'      => __( 'Yellow', 'tcellulose' ),
			'amber'       => __( 'Amber', 'tcellulose' ),
			'orange'      => __( 'Orange', 'tcellulose' ),
			'deep-orange' => __( 'Deep Orange', 'tcellulose' )
		)
	) ) );
}

function tcellulose_customize_css() {
	$accent_colors = array( // Taken from Material Design
		'red'         => array( '#FF8A80', '#FF5252', '#FF1744', '#D50000'),
		'pink'        => array( '#FF80AB', '#FF4081', '#F50057', '#C51162' ),
		'purple'      => array( '#EA80FC', '#E040FB', '#D500F9', '#D500F9' ),
		'deep-purple' => array( '#B388FF', '#7C4DFF', '#651FFF', '#6200EA' ),
		'indigo'      => array( '#8C9EFF', '#536DFE', '#3D5AFE', '#304FFE' ),
		'blue'        => array( '#82B1FF', '#448AFF', '#2979FF', '#2962FF' ),
		'light-blue'  => array( '#80D8FF', '#40C4FF', '#00B0FF', '#0091EA' ),
		'cyan'        => array( '#84FFFF', '#18FFFF', '#00E5FF', '#00B8D4' ),
		'teal'        => array( '#A7FFEB', '#64FFDA', '#1DE9B6', '#00BFA5' ),
		'green'       => array( '#B9F6CA', '#69F0AE', '#00E676', '#00C853' ),
		'light-green' => array( '#CCFF90', '#B2FF59', '#76FF03', '#64DD17' ),
		'lime'        => array( '#F4FF81', '#EEFF41', '#C6FF00', '#AEEA00' ),
		'yellow'      => array( '#FFFF8D', '#FFFF00', '#FFEA00', '#FFD600' ),
		'amber'       => array( '#FFE57F', '#FFD740', '#FFC400', '#FFAB00' ),
		'orange'      => array( '#FFD180', '#FFAB40', '#FF9100', '#FF6D00' ),
		'deep-orange' => array( '#FF9E80', '#FF6E40', '#FF3D00', '#DD2C00' )
	);
	$accent_color = $accent_colors['indigo'];
	$accent_option = get_theme_mod( 'tcellulose_accent_color' );
	if ( ( gettype( $accent_option ) == 'string' ) && array_key_exists( $accent_option, $accent_colors ) ) {
		$accent_color = $accent_colors[$accent_option];
	}
	$light_threshold = 170;
	?>
	<style>
	<?php echo( "/* Accent Color: $accent_option */\n" ); ?>

	.site-header,
	.site-header a,
	footer.page-footer {
		background-color: <?php echo( get_theme_mod( 'tcellulose_primary_color' ) ); ?>;
		color: <?php echo( tcellulose_rgb_brightness( tcellulose_hex_to_rgb( get_theme_mod( 'tcellulose_primary_color' ) ) ) > $light_threshold ? 'black' : 'white' ); ?>;
	}

	a {
		color: <?php echo( $accent_color[3] ); ?>;
	}

	.btn,
	.btn-floating,
	.btn-floating i,
	.btn-large,
	.entry-comments .submit,
	.pagination > li.active,
	.pagination > li.active > a {
		background-color: <?php echo( $accent_color[2] ); ?>;
		color: <?php echo( tcellulose_rgb_brightness( tcellulose_hex_to_rgb( $accent_color[2] ) ) > $light_threshold ? 'black' : 'white' ); ?>;
	}

	.btn:hover,
	.btn-floating:hover,
	.btn-large:hover,
	.entry-comments .submit:hover {
		background-color: <?php echo( $accent_color[1] ); ?>;
	}
	</style>
<?php }

add_action( 'customize_register', 'tcellulose_customize_register' );
add_action( 'wp_head', 'tcellulose_customize_css' );

?>
