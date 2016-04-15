<!DOCTYPE html>
<html <?php language_attributes(); ?>>

	<head>
		<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>

		<header class="site-header">

			<?php if ( is_active_sidebar( 'cellulose-sidebar' ) ): ?>
				<a href="#cellulose-sidebar" data-activates="cellulose-sidebar" class="sidebar-trigger"><i class="material-icons">menu</i></a>
			<?php endif; ?>

			<<?php echo( is_front_page() ? 'h1' : 'p' ); ?> class="site-title">
				<a href="<?php echo( esc_url( home_url( '/', 'relative' ) ) ); ?>">
					<?php echo( esc_html( get_bloginfo( "name" ) ) ); ?>
				</a>
			</<?php echo( is_front_page() ? 'h1' : 'p' ); ?>>

			<nav class="site-navigation hide-tab-scrollbar">
				<?php

				// TODO:30 Add support for submenus

				wp_nav_menu( array(

				"theme_location" => "navigation",
				"depth" => -1,
				"container" => false,
				"fallback_cb" => ""

				) );

				?>
			</nav>

		</header>
