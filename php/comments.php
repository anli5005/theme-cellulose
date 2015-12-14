<?php if ( comments_open() || get_comments_number() != 0 ): ?>
<div class="entry-comments">
	<h3 class="comments-count">
		<i class="entry-comments-icon material-icons" aria-hidden="true">comment</i>
		<?php comments_number( __( 'No', 'tcellulose' ), '1', '%' ); ?>
		<?php echo( sprintf( _n( ' thought on "%1$s"', ' thoughts on "%1$s"', get_comments_number(), 'tcellulose' ), get_the_title() ) ); ?>
	</h3>
	<ul class="comments-list">
		<?php wp_list_comments(); ?>
	</ul>
	<?php comment_form(); ?>
</div>
<?php endif; ?>
