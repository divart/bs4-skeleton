<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Bootstrap_4
 * @since 1.0
 * @version 1.0
 */

if ( ! is_active_sidebar( 'secondary' ) || bs4_option( 'layout' ) == 'no-sidebars' ) return; ?>
<?php do_action( 'open_secondary' ); ?>
<aside id="secondary" <?php bs4_column_class( 'col_secondary', 'widget-area col_secondary' ); ?> role="complementary">
	<?php dynamic_sidebar( 'secondary' ); ?>
</aside><!-- #secondary -->
<?php do_action( 'close_secondary' ); ?>
