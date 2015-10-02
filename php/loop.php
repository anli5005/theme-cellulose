<?php
if ( have_posts() ):
	
	while ( have_posts() ): 
	the_post(); ?>
	<article <?php post_class(); ?>>
		<header class="entry-header">
			<h2 class="entry-title"><a href="<?php echo( esc_url( get_permalink() ) ); ?>"><?php the_title(); ?></a></h3>
			<?php get_template_part( "entry-details" ); ?>
		</header>
		<div class="entry-content">
			<?php if ( has_post_thumbnail() ): ?>
			<div class="entry-featured-image">
				<?php
					the_post_thumbnail( 'medium', array( 'class' => "attachment-medium responsive-img" ) );
				?>
			</div>
			<?php endif;
			the_content(); ?>
		</div>
	</article>
	<?php endwhile;
	
endif;

?>