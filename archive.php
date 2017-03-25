<?php
/**
 * The template for displaying archive pages
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
	do_action( 'open_archive' );

		if ( have_posts() ) :

			?><header class="page-header"><?php
				the_archive_title( '<h1 class="entry-title">', '</h1>' );
				the_archive_description( '<div class="taxonomy-description">', '</div>' );
			?></header><!-- .page-header --><?php

		endif;

		if ( have_posts() ) :

			// Start the loop
			while ( have_posts() ) : the_post();

				global $post;
				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/loop', $post->post_type );

			endwhile;

			bs4_pagination();

		else :

			get_template_part( 'template-parts/post/content', 'none' );

		endif;

	do_action( 'close_archive' );
	do_action( 'close_content' );
get_footer();
