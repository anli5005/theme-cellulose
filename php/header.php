<!DOCTYPE html>
<html>
	
	<head>
		
		<title><?php echo( esc_html( get_bloginfo( "name" ) . wp_title( "-", FALSE, "left" ) ) ); ?></title>
		
		<meta name="viewport" content="width=device-width,initial-scale=1">
		
		<?php wp_head(); ?>
		
	</head>
	
	<body <?php body_class(); ?>>
		
		<header class="site-header <?php echo( tcellulose_header_expanded() ? "expand expanded " : "" ); ?>">
			
			<<?php echo( is_front_page() ? 'h1' : 'p' ); ?> class="site-title"><a href="<?php echo( esc_url( home_url( "/", "relative" ) ) ); ?>"><?php echo( esc_html( get_bloginfo( "name" ) ) ); ?></a></h1>
			<?php if ( tcellulose_header_expanded() ): ?>
				<p class="site-tagline"><?php echo( esc_html( get_bloginfo( "description" ) ) ); ?></p>
				
				<<?php echo( is_front_page() ? 'p' : 'h1' ); ?> class="page-title"><?php
					
					if ( is_page() ) {
						echo( esc_html( get_the_title() ) );
					} elseif ( is_front_page() && is_home() )  {
						_e( "Home", "tcellulose" );
					} else {
						echo( esc_html( wp_title( "", FALSE )  ) );
					}
					
				?></h2>
			<?php endif; ?>
			
			<nav class="site-navigation">
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