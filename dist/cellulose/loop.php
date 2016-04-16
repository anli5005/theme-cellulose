<div class="container main" id="content">
<?php // TODO: Titles for search and author pages
if ( have_posts() ):

	while ( have_posts() ):
		the_post(); ?>
		<article <?php post_class( is_singular() ? 'card' : 'card hoverable' ); ?>>
			<?php if ( has_post_thumbnail() ): ?>
				<div class="card-image">
					<a href="<?php echo( esc_url( get_permalink() ) ); ?>">
					<?php
					the_post_thumbnail( 'large', array( 'class' => "attachment-large responsive-img" ) );
					?>
					<h2 class="card-title entry-title"><?php the_title(); ?></h2>
				</a>
				</div>
			<?php endif; ?>
			<div class="card-content">
				<header class="entry-details">
					<?php if ( ! has_post_thumbnail() ): ?><h2 class="card-title entry-title">
						<a href="<?php echo( esc_url( get_permalink() ) ); ?>">
							<?php echo( empty( get_the_title() ) ? '<span class="entry-title-placeholder">No Title</span>' : get_the_title() ); ?>
						</a>
					</h2><?php endif; ?>
					<?php get_template_part( "entry-details" ); ?>
					</header>
					<div class="entry-content">
						<?php is_singular() ? ( the_content() || wp_link_pages() ) : the_excerpt(); // TODO: Beautify wp_link_pages output ?>
					</div>
				</div>
				<?php if ( is_single() && ( ! empty( get_theme_mod( 'cellulose_enable_author_biographies' ) ) ) && get_the_author_meta( 'description' ) != '' ): ?>
					<div class="entry-author-bio">
						<h3>
							<?php echo( get_avatar( get_the_author_meta( 'ID' ), 48, get_option( 'avatar_default', 'mystery' ), '', array(
								'class' => 'circle entry-avatar'
							) ) ); ?>
							<?php the_author(); ?>
						</h3>
						<div><?php the_author_meta( 'description' ); ?></div>
						<p><a class="btn-flat waves-effect">Read more by <?php the_author(); ?> <span class="material-icons">arrow_forward</span></a></p>
					</div>
				<?php endif; ?>
				<?php comments_template(); ?>
			</article>
		<?php endwhile; ?>
		<?php if ( ! empty( get_the_posts_pagination() ) ): ?>
			<div class="cellulose-pagination">
				<?php if ( get_next_posts_link() ): ?>
					<div class="pagination-link">
						<?php next_posts_link( '<i class="material-icons">navigate_before</i>' ); ?>
						<span>Older</span>
					</div>
				<?php endif; ?>
				<div class="card-panel">
					<?php
						$base_pagination = preg_replace( '/ul.+class=["\']page-numbers["\']/', 'ul class="pagination"', paginate_links( array(
							'prev_next' => false,
							'type' => 'list'
						) ) );
						$revised_pagination = preg_replace( '/<li><span +class=(["\'])(.+ current)\\g1>(\\d+)<\\/span><\\/li>/', '<li class=\\1active\\1><a class=\\1\\2\\1>\\3</a></li>', $base_pagination );
						echo( $revised_pagination );
					 ?>
				</div>
				<?php if ( get_previous_posts_link() ): ?>
					<div class="pagination-link">
						<span>Newer</span>
						<?php previous_posts_link( '<i class="material-icons">navigate_next</i>' ); ?>
					</div>
				<?php endif; ?>
			</div>
		<?php endif; ?>
<?php endif; ?>
</div>
