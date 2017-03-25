<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
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
	do_action( 'open_search' );

		if ( have_posts() ) :

			// Start the loop
			while ( have_posts() ) : the_post();

				global $post;
				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called loop-___.php (where ___ is the Post Type) and that will be used instead.
				 */
				get_template_part( 'template-parts/loop', $post->post_type );

			endwhile;

			the_posts_pagination( [
				'prev_text' 		 => '<span class="screen-reader-text">' . __( 'Previous page', 'bs4' ) . '</span>',
				'next_text' 		 => '<span class="screen-reader-text">' . __( 'Next page', 'bs4' ) . '</span>',
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'bs4' ) . ' </span>',
			] );

		else : ?>

			<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'bs4' ); ?></p>
			<?php
				get_search_form();

		endif;

	do_action( 'close_search' );
	do_action( 'close_content' );
get_footer();
