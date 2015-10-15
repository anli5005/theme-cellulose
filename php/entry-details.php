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
				echo( '<a href="' . esc_url( get_tag_link( $tag->term_id ) ) . '" class="' . esc_attr( $tag->slug ) . '">' . esc_html( $tag->name ) . '</a>' );
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
				echo( '<a href="' . esc_url( get_category_link( $cat->term_id ) ) . '" class="' . esc_attr( $cat->slug ) . '">' . esc_html( $cat->name ) . '</a>' );
				if ( $k < ( count( $cats ) - 1 ) ) {
					echo( ", " );
				}
			}
		?>
	</div>
	<?php endif; ?>
</div>