<?php
	global $tcellulose_search_form_number;
	$tcellulose_search_form_number = isset( $tcellulose_search_form_number ) ? $tcellulose_search_form_number + 1 : 1;
?>
<form role="search" method="get" class="search-form waves-effect card-panel white" action="<?php echo home_url( '/' ); ?>">
	<span class="screen-reader-only"><?php _e( 'Search for:', 'tcellulose' ) ?></span>
	<label for="<?php echo( "search-field-$tcellulose_search_form_number" ); ?>" class="material-icons" aria-hidden="true">search</label>
	<input type="text" id="<?php echo( "search-field-$tcellulose_search_form_number" ); ?>" class="search-field" name="s" title="<?php _e( 'Search for:', 'tcellulose' ) ?>" placeholder="<?php _e( 'Search', 'tcellulose' ); ?>" />
</form>