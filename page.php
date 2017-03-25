<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
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
	do_action( 'top_breadcrumbs' );
	do_action( 'open_single' );

		while ( have_posts() ) : the_post();

			global $post;
			get_template_part( 'template-parts/single', $post->post_type );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :

				comments_template();

			endif;

		endwhile; // End of the loop.

	do_action( 'close_single' );
	do_action( 'close_content' );
get_footer();
