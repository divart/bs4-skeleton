<?php
/**
 * Displays footer widgets if assigned
 *
 * @package WordPress
 * @subpackage Bootstrap_4
 * @since 1.0
 * @version 1.0
 */

?>

<?php if ( is_active_sidebar( 'footer' ) ) : ?>

	<aside class="widget-area" role="complementary">

		<?php if ( is_active_sidebar( 'footer' ) ) : ?>

			<div <?php bs4_row_class( 'row_footer', 'row_footer' ); ?>>
				<?php dynamic_sidebar( 'footer' ); ?>
			</div>

		<?php endif; ?>

	</aside><!-- .widget-area -->

<?php endif; ?>
