<?php

$tcellulose_header_expanded = ( is_front_page() || is_page() || is_archive() );

?>
<!DOCTYPE html>
<html>
	
	<head>
		
		<title><?php echo( esc_html( get_bloginfo( "name" ) . wp_title( "-", FALSE, "left" ) ) ); ?></title>
		
		<meta name="viewport" content="width=device-width,initial-scale=1">
		
		<?php wp_head(); ?>
		
	</head>
	
	<body <?php echo( esc_attr( body_class() ) ); ?>>
		
		<header class="site-header <?php echo( $tcellulose_header_expanded ? "expanded " : "" ); ?>z-depth-4 grey lighten-4 black-text">
			
			<h1 class="site-title"><?php echo( esc_html( get_bloginfo( "name" ) ) ); ?></h1>
			<?php if ( $tcellulose_header_expanded ): ?>
				<p class="site-tagline"><?php echo( esc_html( get_bloginfo( "description" ) ) ); ?></p>
				
				<h2 class="page-title">
					<?php
					
					if ( is_page() ) {
						echo( esc_html( get_the_title() ) );
					} else if ( is_home() ) {
						_e( "Home", "tcellulose" );
					}
					
					?>
				</h2>
			<?php endif; ?>
			
			<nav class="site-navigation">
				<ul class="tabs">
					<li class="tab active"><a href="." class="blue-text text-accent-3">Hashtag</a></li>
					<li class="tab"><a href="?p=1" class="black-text">Test</a></li>
				</ul>
			</nav>
			
		</header>