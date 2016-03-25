<?php if ( get_post_type() == 'post' ): ?>
	<div class="entry-author col s12 m4 l4">
		<?php echo( get_avatar( get_the_author_meta( 'ID' ), 48, get_option( 'avatar_default', 'mystery' ), '', array(
			'class' => 'circle entry-avatar'
		) ) ); ?>
		<p><?php the_author(); ?></p>
		<p><?php echo( get_the_date() ); ?></p>
	</div>
	<div class="entry-taxonomies">
	<?php if ( has_tag() ): ?>
	<div class="entry-tags">
		<span class="screen-reader-text">Tags: </span>
		<?php
			$tags = get_the_tags();
			foreach ( $tags as $k => $tag ) {
				echo( '<a href="' . esc_url( get_tag_link( $tag->term_id ) ) . '" class="chip"><span class="material-icons" aria-hidden="true">local_offer</span> ' . esc_html( $tag->name ) . '</a>' );
			}
		?>
	</div>
	<?php endif; ?>
	<?php if ( has_category() ): ?>
	<div class="entry-categories">
		<span class="screen-reader-text">Categories: </span>
		<?php
			$cats = get_the_category();
			foreach ( $cats as $k => $cat ) {
				echo( '<a href="' . esc_url( get_category_link( $cat->term_id ) ) . '" class="' . esc_attr( $cat->slug ) . ' chip"><span class="material-icons" aria-hidden="true">folder</span> ' . esc_html( $cat->name ) . '</a>' );
			}
		?>
	</div>
<?php endif; ?>
</div>
<?php endif; ?>
