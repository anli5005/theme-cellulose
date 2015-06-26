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
		
		<header class="<?php echo( $tcellulose_header_expanded ? "expanded " : "" ); ?>z-depth-4 grey lighten-4 black-text">
			<?php if ( $tcellulose_header_expanded ): ?>
				
				<h1 class="site-name"><?php echo( esc_html( get_bloginfo( "name" ) ) ); ?></h1>
				<p class="site-tagline"><?php echo( esc_html( get_bloginfo( "description" ) ) ); ?></p>
			<?php endif; ?>
			
			<nav class="site-navigation">
				<?php if( !$tcellulose_header_expanded ): ?>
					<h1 class="site-name"><?php echo( esc_html( get_bloginfo( "name" ) ) ); ?></h1>
				<?php endif; ?>
				<div class="row">
					<div class="col s12">
						<ul class="tabs">
							<li class="tab active col s3"><a href="." class="blue-text text-accent-3">Hashtag</a></li>
							<li class="tab col s3"><a href="?p=1" class="black-text">Test</a></li>
						</ul>
					</div>
				</div>
			</nav>
			
		</header>