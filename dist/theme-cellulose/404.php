<?php

get_header();

?>

<div class="main" id="#content">
	
	<h2><?php _e( "Error 404", "tcellulose" ); ?></h2>
	<p><?php _e( "It looks like the page you requested wasn't found. Want to try searching the website?" ); ?></p>
	<?php get_search_form(); ?>
	
</div>

<?php

get_footer();

?>