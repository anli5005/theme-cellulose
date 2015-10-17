<?php
if ( have_posts() ):

	while ( have_posts() ):
		the_post(); ?>
		<article <?php post_class( is_singular() ? 'card' : 'card hoverable' ); ?>>
			<?php if ( has_post_thumbnail() ): ?>
				<div class="card-image entry-featured-image-css-support-coming-soon">
					<?php
					the_post_thumbnail( 'large', array( 'class' => "attachment-large responsive-img" ) );
					?>
					<h2 class="card-title entry-title"><a href="<?php echo( esc_url( get_permalink() ) ); ?>"><?php the_title(); ?></a></h2>
				</div>
			<?php endif; ?>
			<div class="card-content">
				<header class="entry-details">
					<?php if ( ! has_post_thumbnail() ): ?><h2 class="card-title entry-title"><a href="<?php echo( esc_url( get_permalink() ) ); ?>"><?php the_title(); ?></a></h2><?php endif; ?>
						<?php get_template_part( "entry-details" ); ?>
					</header>
					<div class="entry-content">
						<?php is_singular() ? the_content() : the_excerpt(); ?>
					</div>
				</div>
			</article>
		<?php endwhile;

	endif;

	?>
