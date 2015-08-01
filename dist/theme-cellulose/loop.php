<?php
if ( have_posts() ):
	
	while ( have_posts() ): 
	the_post(); ?>
	<article <?php post_class(); ?>>
		<?php if ( !is_page() ): ?>
		<header class="entry-header">
			<h3 class="entry-title"><a href="<?php echo( esc_url( get_permalink() ) ); ?>"><?php the_title(); ?></a></h3>
			<div class="entry-details">
				<?php if ( get_post_type() == 'post' ): ?>
				<div class="entry-author">
					<i class="material-icons">account_circle </i>
					<span class="screen-reader-only">Author: </span>
					<?php the_author(); ?>
				</div>
				<div class="entry-date">
					<i class="material-icons" aria-hidden="true">event </i>
					<span class="screen-reader-only">Date Published: </span>
					<?php echo( get_the_date() ); ?>
				</div>
				<?php endif; ?>
				<?php if ( has_tag() ): ?>
				<div class="entry-tags">
					<i class="material-icons" aria-hidden="true">local_offer </i>
					<span class="screen-reader-only">Tags: </span>
					<?php
						$tags = get_the_tags();
						foreach ( $tags as $k => $tag ) {
							echo( $tag->name );
							if ( $k < ( count( $tags ) - 1 ) ) {
								echo( ", " );
							}
						}
					?>
				</div>
				<?php endif; ?>
				<?php if ( has_category() ): ?>
				<div class="entry-categories">
					<i class="material-icons" aria-hidden="true">folder </i>
					<span class="screen-reader-only">Categories: </span>
					<?php
						$cats = get_the_category();
						foreach ( $cats as $k => $cat ) {
							echo( $cat->name );
							if ( $k < ( count( $cats ) - 1 ) ) {
								echo( ", " );
							}
						}
					?>
				</div>
				<?php endif; ?>
			</div>
		</header>
		<?php endif; ?>
		<div class="entry-content">
			<?php the_content(); ?>
		</div>
	</article>
	<?php endwhile;
	
endif;

?>