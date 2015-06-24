<!DOCTYPE html>
<html>
	
	<head>
		
		<title><?php echo( esc_html( bloginfo( "name" ) . wp_title( "-", FALSE, "left" ) ) ); ?></title>
		
		<meta name="viewport" content="width=device-width,initial-scale=1">
		
		<?php wp_head(); ?>
		
	</head>
	
	<body <?php echo( esc_attr( body_class() ) ); ?>>
		
		<?php wp_footer(); ?>
		
	</body>
	
</html>