<?php
/**
 * Template for displaying a search form in the top navbar.
 *
 * @package WordPress
 * @subpackage Bootstrap_4
 * @since 1.0
 * @version 1.0
 */
?>

<?php $unique_id = esc_attr( uniqid( 'nav-search-form-' ) ); ?>

<form role="search" method="get" class="nav-search form-inline" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="<?php echo $unique_id; ?>">
		<span class="screen-reader-text"><?php echo _x( 'Search for:', 'label', 'bs4' ); ?></span>
	</label>
	<div class="input-group">
		<span class="input-group-btn">
			<button type="submit" class="search-submit btn btn-secondary">
				<?php echo _x( '<i class="fa fa-search"></i>', 'bs4' ); ?>
			</button>
		</span>
		<input type="search" id="<?php echo $unique_id; ?>" class="form-control" placeholder="<?php echo esc_attr_x( 'Search&hellip;', 'placeholder', 'bs4' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	</div>
</form>
