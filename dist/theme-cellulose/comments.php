<?php if ( comments_open() || get_comments_number() != 0 ): ?>
<div class="entry-comments">
	<i class="entry-comments-icon material-icons" aria-hidden="true"><?php comments_number( 'comment', 'mode_comment', 'mode_comment' ); ?></i>
	<h3 class="comments-count">
		<span class="<?php comments_number( 'comments-number-zero', 'comments-number', 'comments-number' ); ?>"><?php comments_number( __( 'No', 'tcellulose' ), '1', '%' ); ?></span>
		<?php echo( sprintf( _n( ' thought on "%1$s"', ' thoughts on "%1$s"', get_comments_number(), 'tcellulose' ), get_the_title() ) ); ?>
	</h3>
</div>
<?php endif; ?>