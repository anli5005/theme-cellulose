<?php

get_header();

?>

<div class="row">
	<?php $content_size = is_active_sidebar( 'tcellulose-sidebar' ) ? '7' : '10' ?>
	<div class="<?php echo("main col s10 m$content_size l$content_size offset-s1 offset-m1 offset-l1") ?>" id="content">
		<?php get_template_part( 'loop' ); ?>
	</div>
	
	<?php get_sidebar(); ?>
</div>

<?php

get_footer();

?>