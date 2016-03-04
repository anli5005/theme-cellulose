<?php
	global $cellulose_search_form_number;
	$cellulose_search_form_number = isset( $cellulose_search_form_number ) ? $cellulose_search_form_number + 1 : 1;
?>
<form role="search" method="get" class="search-form waves-effect card-panel white" action="<?php echo home_url( '/' ); ?>">
	<span class="screen-reader-text"><?php _e( 'Search', 'cellulose' ) ?></span>
	<label for="<?php echo( "search-field-$cellulose_search_form_number" ); ?>" class="material-icons" aria-hidden="true">search</label>
	<input type="text" id="<?php echo( "search-field-$cellulose_search_form_number" ); ?>" class="search-field" name="s" title="<?php _e( 'Search for:', 'cellulose' ) ?>" placeholder="<?php _e( 'Search', 'cellulose' ); ?>" />
</form>
