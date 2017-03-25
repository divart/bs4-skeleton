<?php

/**
 * Search
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<form role="search" method="get" id="bbp-search-form" action="<?php bbp_search_url(); ?>">
	<div class="form-group">
		<div class="input-group">
			<label class="screen-reader-text hidden" for="bbp_search"><?php _e( 'Search for:', 'bs4' ); ?></label>
			<span class="input-group-btn">
				<button id="bbp_search_submit" tabindex="<?php bbp_tab_index(); ?>" type="submit" class="btn btn-secondary" type="button"><i class="fa fa-search"></i></button>
			</span>
			<input type="hidden" name="action" value="bbp-search-request" />
			<input id="bbp_search" type="text" name="bbp_search" class="form-control" value="<?php echo esc_attr( bbp_get_search_terms() ); ?>" placeholder="<?php _e( 'Search', 'bs4' ); ?>" tabindex="<?php bbp_tab_index(); ?>" />
		</div>
	</div>
</form>
