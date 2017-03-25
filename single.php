<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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
	/**
	 * top_breadcrumbs hook.
	 */
	do_action( 'top_breadcrumbs' );
	do_action( 'open_single' );

		// Start the loop
		while ( have_posts() ) : the_post();

			global $post;
			get_template_part( 'template-parts/single', $post->post_type );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :

				comments_template();

			endif;

			the_post_navigation( array(
				'prev_text' => '<span class="nav-title"><span class="nav-title-icon-wrapper"><i class="fa fa-arrow-left"></i></span> Previous</span>',
				'next_text' => '<span class="nav-title"><span class="nav-title-icon-wrapper"><i class="fa fa-arrow-right"></i></span> Next</span>',
			) );

		endwhile; // End of the loop.

	do_action( 'close_single' );
	do_action( 'close_content' );
get_footer();
