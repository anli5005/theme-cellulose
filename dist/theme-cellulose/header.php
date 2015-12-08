<!DOCTYPE html>
<html>

	<head>
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<?php wp_head(); ?>
		<script>
		// TODO: This is against the WordPress guidelines. Switching this later
		jQuery(function() {
			jQuery(".sidebar-trigger").sideNav();
		});
		</script>
	</head>

	<body <?php body_class(); ?>>

		<header class="site-header">

			<a href="#" data-activates="tcellulose-sidebar" class="sidebar-trigger"><i class="material-icons">menu</i></a>

			<<?php echo( is_front_page() ? 'h1' : 'p' ); ?> class="site-title">
				<a href="<?php echo( esc_url( home_url( '/', 'relative' ) ) ); ?>">
					<?php echo( esc_html( get_bloginfo( "name" ) ) ); ?>
				</a>
			</<?php echo( is_front_page() ? 'h1' : 'p' ); ?>>

			<nav class="site-navigation hide-tab-scrollbar">
				<?php

				// TODO: Add support for submenus
				// TODO: Add pagination on tabs for desktop

				wp_nav_menu( array(

				"theme_location" => "navigation",
				"depth" => -1,
				"container" => false,
				"fallback_cb" => "tcellulose_navigation_fallback"

				) );

				?>
			</nav>

		</header>
