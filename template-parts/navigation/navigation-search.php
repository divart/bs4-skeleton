<?php
/**
 * Displays top navigation search
 *
 * @package WordPress
 * @subpackage Bootstrap_4
 * @since 1.0
 * @version 1.0
 */

global $bs4_defaults;
$unique_id = esc_attr( uniqid( 'search-form-' ) );
?>
<?php if ( bs4_option( 'top_nav_search' ) ) : ?>
    <form role="search" method="get" <?php bs4_form_class( 'top_nav_search', 'nav-search search-form form-inline' ); ?> class="" action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <label for="<?php echo $unique_id; ?>" class="screen-reader-text"><?php echo _x( 'Search for:', 'label', 'bs4' ); ?></label>
        <div class="input-group">
            <span class="input-group-btn">
                <button type="submit" class="search-submit btn btn-secondary"><?php echo _x( '<i class="fa fa-search"></i>', 'bs4' ); ?></button>
            </span>
            <input type="search" id="<?php echo $unique_id; ?>" class="search-field form-control" placeholder="<?php echo esc_attr_x( 'Search&hellip;', 'placeholder', 'bs4' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
        </div>
    </form>
<?php endif; ?>
