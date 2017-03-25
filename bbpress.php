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
	do_action( 'bbp_template_notices' );
	do_action( 'bbp_before_main_content' );

		if ( have_posts() ) :

			// Start the loop
			while ( have_posts() ) : the_post();

                global $post;
                /*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called loop-___.php (where ___ is the Post Type) and that will be used instead.
				 */
				get_template_part( 'template-parts/bbpress', $post->post_type );

			endwhile;

			bs4_pagination();

		else :

			get_template_part( 'template-parts/post/content', 'none' );

		endif;

	do_action( 'bbp_after_main_content' );
	do_action( 'close_content' );
get_footer();
