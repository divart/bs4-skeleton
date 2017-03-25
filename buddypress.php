<?php
/**
 * The BuddyPress main index file
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
 * @since 1.0
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
	do_action( 'open_buddypress' );

		if ( have_posts() ) :

			// Start the loop
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/buddypress' );

			endwhile;

			the_posts_pagination( array(
				'prev_text' => '<span class="screen-reader-text">' . __( 'Previous page', 'bs4' ) . '</span>',
				'next_text' => '<span class="screen-reader-text">' . __( 'Next page', 'bs4' ) . '</span>',
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'bs4' ) . ' </span>',
			) );

		else :

			get_template_part( 'template-parts/post/content', 'none' );

		endif;

	do_action( 'close_buddypress' );
	do_action( 'close_content' );
get_footer();
