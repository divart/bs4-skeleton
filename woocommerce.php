<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Bootstrap_4
 * @since   1.0
 * @version 1.0
 */

get_header();
	/**
	 * open_content hook.
	 *
	 * @hooked bs4_before_content_add_container_open - 20
	 * @hooked bs4_display_left_sidebar - 40
	 * @hooked bs4_open_content_primary_open - 60
	 */
	do_action( 'open_content' );
	do_action( 'wc_before_main_content' );

        if ( is_singular( 'product' ) ) :

            woocommerce_content();

        else :

			do_action( 'open_loop_product' );
				wc_get_template_part( 'archive', 'product' );
			do_action( 'close_loop_product' );

        endif;

	do_action( 'wc_after_main_content' );
	do_action( 'close_content' );
get_footer();
