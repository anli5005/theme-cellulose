<?php

get_header();

?>

<div class="row">
	<?php if ( have_posts() ):
		while ( have_posts() ):
			the_post();
			$content_size = is_active_sidebar( 'tcellulose-sidebar' ) ? '7' : '10';
	?>
	<?php if ( has_post_thumbnail() ): ?>
		<div class="entry-featured-image parallax-container">
			<div class="parallax">
				<script>
					jQuery( window ).load( function() {
						jQuery( ".entry-featured-image .parallax" ).parallax();
					} );
				</script>
				<?php
					the_post_thumbnail( 'large', array( 'class' => 'attachment-large' ) );
				?>
			</div>
		</div>
	<?php endif; ?>
	<div class="<?php echo("main col s10 m$content_size l$content_size offset-s1 offset-m1 offset-l1") ?>" id="content">
		<article <?php post_class(); ?>>
			<?php if ( ! is_page() ): ?>
			<header class="entry-header">
				<h2 class="entry-title"><a href="<?php echo( esc_url( get_permalink() ) ); ?>"><?php the_title(); ?></a></h2>
				<?php get_template_part( "entry-details" ); ?>
			</header>
			<?php endif; ?>
			<div class="entry-content">
				<?php the_content(); ?>
			</div>
			<?php comments_template(); ?>
		</article>
	</div>
	
	<?php endwhile; endif; ?>
	
	<?php get_sidebar(); ?>
</div>

<?php

get_footer();

?>