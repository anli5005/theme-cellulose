<?php

get_header();

?>

<div class="row">
	<?php $content_size = is_active_sidebar( 'cellulose-sidebar' ) ? '7' : '10' ?>
	<div class="<?php echo("main col s10 m$content_size l$content_size offset-s1 offset-m1 offset-l1") ?>" id="content">
		<h2><?php _e( "Error 404", 'cellulose' ); ?></h2>
		<p><?php _e( "It looks like the page you requested wasn't found. Want to try searching the website?", 'cellulose' ); ?></p>
		<?php get_search_form(); ?>
	</div>
</div>
<?php get_sidebar(); ?>

<?php

get_footer();

?>
