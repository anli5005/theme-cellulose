<?php

function cellulose_accent_colors() {
	return array( // Taken from Material Design
		'red'         => array( '#FF8A80', '#FF5252', '#FF1744', '#D50000' ),
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
}

function cellulose_esc_color( $color ) {
	return preg_replace( '/[^a-fA-F#0-9]/', '', $color );
}

function cellulose_verify_accent_color( $color ) {
	return array_key_exists( $color, cellulose_accent_colors() );
}

function cellulose_esc_accent_color( $color ) {
	return cellulose_verify_accent_color( $color ) ? $color : 'indigo';
}

function cellulose_enqueue_styles() {
	wp_enqueue_style( "roboto", "//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic" );
	wp_enqueue_style( "material-icons", "//fonts.googleapis.com/icon?family=Material+Icons" );
	wp_enqueue_style( "cellulose-styles", get_template_directory_uri() . "/style.min.css" );
}

function cellulose_enqueue_script() {
	wp_enqueue_script( "jquery" );
	wp_enqueue_script( "cellulose-js", get_template_directory_uri() . "/js/scripts.min.js", array( "jquery" ) );
	if ( is_singular() ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

function cellulose_register_menus() {
	register_nav_menu( "navigation", __( "Tabs", "cellulose" ) );
}

/* function cellulose_header_expanded() {
	return ( is_front_page() || is_page() || is_archive() || is_home() );
} */

function cellulose_add_body_classes( $classes ) {
	/* if ( cellulose_header_expanded() ) {
		$classes[] = "expanded-header";
	} */
	if ( is_singular() ) {
		$classes[] = 'singular';
		if ( get_post_meta( get_the_ID(), '_cellulose_post_layout', true ) == 'fullwidth' ) {
			$classes[] = 'cellulose-full-width';
		}
	} else {
		if ( ! empty( get_theme_mod( 'cellulose_use_grid_layout' ) ) ) {
			$classes[] = 'masonry';
		}
	}
	if ( empty( get_theme_mod( 'cellulose_truncate_taxonomies' ) ) ) {
		$classes[] = 'chip-clipping-off';
	}
	if ( wp_nav_menu( array(

	"theme_location" => "navigation",
	"depth" => -1,
	"container" => false,
	"fallback_cb" => "",
	'echo' => false

	) ) == '') {
		$classes[] = "empty-navigation";
	}
	return $classes;
}

function cellulose_register_widget_areas() {
	register_sidebar( array(
		'name' => __( 'Sidebar', 'cellulose' ),
		'id' => 'cellulose-sidebar',
		'description' => __( 'The widget area for the theme sidebar', 'cellulose' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h5 class="widget-title">',
		'after_title' => '</h5>'
	) );

	register_sidebar( array(
		'name' => __( 'Footer', 'cellulose' ),
		'id' => 'cellulose-footer',
		'description' => __( 'The widget area for the theme footer', 'cellulose' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h5 class="widget-title">',
		'after_title' => '</h5>'
	) );
}

function cellulose_add_theme_support() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );
	add_theme_support( 'custom-logo', array(
		'height' => 168,
		'flex-height' => false,
		'flex-width' => true
	) );
}

function cellulose_add_pagination_button_classes() {
	return 'class="waves-effect waves-light btn-floating"';
}

function cellulose_comment_field_filter( $field ) {
	return preg_replace( '/<p class="([^"]*)">/', '<p class="$1 input-field">', preg_replace( '/<textarea ([^>]*)>/', '<textarea $1 class="materialize-textarea">', $field ) );
}

function cellulose_post_meta_boxes() {
	add_meta_box( 'cellulose-post-layout', __( 'Post Layout', 'cellulose' ), 'cellulose_post_layout_box', get_post_types( array( 'show_ui' => true, '_builtin' => true ) ), 'side', 'core' );
}

function cellulose_charset() { ?>
	<meta charset="utf-8" />
<?php }

function cellulose_content_width() {
	if ( ! isset( $content_width ) ) {
		$content_width = 900;
	}
}

function cellulose_editor_styles() {
	add_editor_style();
}

add_action( "wp_enqueue_scripts", "cellulose_enqueue_styles" );
add_action( "wp_enqueue_scripts", "cellulose_enqueue_script" );

add_action( "after_setup_theme", "cellulose_register_menus"    );
add_action( "after_setup_theme", "cellulose_add_theme_support" );
add_action( "after_setup_theme", "cellulose_content_width" );

add_action( "widgets_init", 'cellulose_register_widget_areas' );

add_action( 'wp_head', 'cellulose_charset' );

add_filter( "body_class", "cellulose_add_body_classes", 10, 1 );

add_filter( 'next_posts_link_attributes',     'cellulose_add_pagination_button_classes', 10, 1 );
add_filter( 'previous_posts_link_attributes', 'cellulose_add_pagination_button_classes', 10, 1 );

add_filter( "comment_form_field_comment", "cellulose_comment_field_filter", 10, 1 );
add_filter( "comment_form_field_author",  "cellulose_comment_field_filter", 10, 1 );
add_filter( "comment_form_field_email",   "cellulose_comment_field_filter", 10, 1 );
add_filter( "comment_form_field_url",     "cellulose_comment_field_filter", 10, 1 );

add_action( 'add_meta_boxes', 'cellulose_post_meta_boxes' );

add_action( 'admin_init', 'cellulose_editor_styles' );

// Meta Boxes

function cellulose_post_layout_box( $post ) { ?>

	<p><?php _e( 'Pick a layout for this post.', 'cellulose' ); ?></p>
	<p>
		<?php $meta_value = get_post_meta( $post->ID, '_cellulose_post_layout', true ); ?>
		<select name="cellulose_post_layout">
			<option value="default"<?php echo( $meta_value == 'normal' ? ' selected' : '' ); ?>>Default Layout</option>
			<option value="fullwidth"<?php echo( $meta_value == 'fullwidth' ? ' selected' : '' ); ?>>Full Width Layout</option>
		</select>
		<?php wp_nonce_field( 'cellulose_post_layout', 'cellulose_post_layout_nonce' ); ?>
	</p>

<?php }
function cellulose_save_post_layout( $post_id, $post ) {
	if ( ! isset( $_POST['cellulose_post_layout'] ) ) {
		return $post_id;
	}
	if ( ! ( isset( $_POST['cellulose_post_layout_nonce'] ) || wp_verify_nonce( $_POST['cellulose_post_layout_nonce'], 'cellulose_post_layout' ) ) ) {
		return $post_id;
	}
	if ( ! current_user_can( get_post_type_object( $post->post_type )->cap->edit_post, $post_id ) ) {
		return $post_id;
	}
	$new_value = $_POST['cellulose_post_layout'];
	$meta_key  = '_cellulose_post_layout';
	$meta_val  = get_post_meta( $post_id, $meta_key, true );

	if ( $new_value == $meta_val ) {
		return $post_id;
	}

	if ( $meta_val == '' ) {
		add_post_meta( $post_id, $meta_key, $new_value, true );
	} else {
		update_post_meta( $post_id, $meta_key, $new_value );
	}

}
add_action( 'save_post', 'cellulose_save_post_layout', 10, 2 );

// Color Manipulation Functions

function cellulose_rgb_to_hex( $rgb ) {
	$hex = '#';
	foreach( $rgb as $element ) {
		$hex .= str_pad( strtoupper( dechex( $element ) ), 2, '0', STR_PAD_LEFT );
	}
	return $hex;
}
function cellulose_hex_to_rgb( $hex ) {
	$trimmed = str_replace( '#', '', $hex );
	$rgb = array();
	for ($i = 0; $i < 3; $i++) {
		$element = substr( $trimmed, $i * 2, 2 );
		$rgb[] = hexdec( $element );
	}
	return $rgb;
}

function cellulose_rgb_brightness( $color ) {
	return sqrt( ( 0.299 * pow( $color[0], 2 ) ) + ( 0.587 * pow( $color[1], 2 ) ) + ( 0.114 * pow( $color[2], 2 ) ) );
}

// Customizer functions

function cellulose_customize_register( $wp_customize ) {
	$default_transport = 'refresh';

	// Colors
	$wp_customize->add_section( 'cellulose_color_settings', array(
		'title'    => __( 'Colors', 'cellulose' ),
		'priority' => 30
	) );
	// Primary Color
	$wp_customize->add_setting( 'cellulose_primary_color', array(
		'default'  => '#2196F3',
		'transport' => $default_transport,
		'sanitize_callback' => 'cellulose_esc_color'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cellulose_primary_color', array(
		'label'    => __( 'Primary Color', 'cellulose' ),
		'settings' => 'cellulose_primary_color',
		'section'  => 'cellulose_color_settings'
	) ) );
	// Accent Color
	$wp_customize->add_setting( 'cellulose_accent_color', array(
		'default' => 'indigo',
		'transport' => $default_transport,
		'sanitize_callback' => 'cellulose_esc_accent_color'
	) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'cellulose_accent_color', array(
		'label'    => __( 'Accent Color', 'cellulose' ),
		'settings' => 'cellulose_accent_color',
		'section'  => 'cellulose_color_settings',
		'type'     => 'select',
		'choices'  => array(
			'red'         => __( 'Red', 'cellulose' ),
			'pink'        => __( 'Pink', 'cellulose' ),
			'purple'      => __( 'Purple', 'cellulose' ),
			'deep-purple' => __( 'Deep Purple', 'cellulose' ),
			'indigo'      => __( 'Indigo', 'cellulose' ),
			'blue'        => __( 'Blue', 'cellulose' ),
			'light-blue'  => __( 'Light Blue', 'cellulose' ),
			'cyan'        => __( 'Cyan', 'cellulose' ),
			'teal'        => __( 'Teal', 'cellulose' ),
			'green'       => __( 'Green', 'cellulose' ),
			'light-green' => __( 'Light Green', 'cellulose' ),
			'lime'        => __( 'Lime', 'cellulose' ),
			'yellow'      => __( 'Yellow', 'cellulose' ),
			'amber'       => __( 'Amber', 'cellulose' ),
			'orange'      => __( 'Orange', 'cellulose' ),
			'deep-orange' => __( 'Deep Orange', 'cellulose' )
		)
	) ) );

	// Layout
	$wp_customize->add_section( 'cellulose_layout_settings',  array(
		'title'    => __( 'Layout', 'cellulose' ),
		'priority' => 30
	) );
	$wp_customize->add_setting( 'cellulose_truncate_taxonomies', array(
		'default' => '1',
		'transport' => $default_transport,
		'sanitize_callback' => 'esc_attr'
	) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'cellulose_truncate_taxonomies', array(
		'label'    => __( 'Truncate tags and categories', 'cellulose' ),
		'type'     => 'checkbox',
		'settings' => 'cellulose_truncate_taxonomies',
		'section'  => 'cellulose_layout_settings'
	) ) );
	$wp_customize->add_setting( 'cellulose_use_grid_layout', array(
		'default' => '1',
		'transport' => $default_transport,
		'sanitize_callback' => 'esc_attr'
	) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'cellulose_use_grid_layout', array(
		'label'    => __( 'Use grid layout for blog posts', 'cellulose' ),
		'type'     => 'checkbox',
		'settings' => 'cellulose_use_grid_layout',
		'section'  => 'cellulose_layout_settings'
	) ) );
	$wp_customize->add_setting( 'cellulose_enable_author_biographies', array(
		'default' => '1',
		'transport' => $default_transport,
		'sanitize_callback' => 'esc_attr'
	) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'cellulose_enable_author_biographies', array(
		'label'    => __( 'Enable author biographies', 'cellulose' ),
		'type'     => 'checkbox',
		'settings' => 'cellulose_enable_author_biographies',
		'section'  => 'cellulose_layout_settings'
	) ) );
}

function cellulose_customize_css() {
	$accent_colors = cellulose_accent_colors();
	$accent_color = $accent_colors['indigo'];
	$accent_option = get_theme_mod( 'cellulose_accent_color' );
	if ( ( gettype( $accent_option ) == 'string' ) && array_key_exists( $accent_option, $accent_colors ) ) {
		$accent_color = $accent_colors[$accent_option];
	}
	$light_threshold = 170;
	?>
	<style>
	.site-header,
	.site-header a,
	footer.page-footer,
	footer.page-footer a {
		background-color: <?php echo( get_theme_mod( 'cellulose_primary_color' ) ); ?>;
		color: <?php echo( cellulose_rgb_brightness( cellulose_hex_to_rgb( get_theme_mod( 'cellulose_primary_color' ) ) ) > $light_threshold ? 'black' : 'white' ); ?>;
	}

	blockquote {
		border-color: <?php echo( get_theme_mod( 'cellulose_primary_color' ) ); ?>;
	}

	a,
	.comments-list li.comment .comment-metadata .comment-edit-link {
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
		color: <?php echo( cellulose_rgb_brightness( cellulose_hex_to_rgb( $accent_color[2] ) ) > $light_threshold ? 'black' : 'white' ); ?>;
	}

	.comments-list li.comment.bypostauthor .comment-author > img {
		border-color: <?php echo( $accent_color[2] ); ?>;
	}

	.btn:hover,
	.btn-floating:hover,
	.btn-large:hover,
	.entry-comments .submit:hover,
	.site-navigation > ul > li.current-menu-item::after {
		background-color: <?php echo( $accent_color[1] ); ?>;
	}
	</style>
<?php }

add_action( 'customize_register', 'cellulose_customize_register' );
add_action( 'wp_head', 'cellulose_customize_css' );

?>
