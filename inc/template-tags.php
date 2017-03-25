<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package WordPress
 * @subpackage Bootstrap_4
 * @since 1.0
 */

if ( ! function_exists( 'bs4_posted_on' ) ) {
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function bs4_posted_on() {

		// Get the author name; wrap it in a link.
		$byline = sprintf(
			/* translators: %s: post author */
			__( 'by %s', 'bs4' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . get_the_author() . '</a></span>'
		);

		// Finally, let's write all of this to the page.
		echo '<span class="posted-on">' . bs4_time_link() . '</span><span class="byline"> ' . $byline . '</span>';
	}
}


if ( ! function_exists( 'bs4_time_link' ) ) {
	/**
	 * Gets a nicely formatted string for the published date.
	 */
	function bs4_time_link() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			get_the_date( DATE_W3C ),
			get_the_date(),
			get_the_modified_date( DATE_W3C ),
			get_the_modified_date()
		);

		// Wrap the time string in a link, and preface it with 'Posted on'.
		return sprintf(
			/* translators: %s: post date */
			__( '<span class="screen-reader-text">Posted on</span> %s', 'bs4' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);
	}
}


if ( ! function_exists( 'bs4_entry_footer' ) ) {
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function bs4_entry_footer() {

		/* translators: used between list items, there is a space after the comma */
		$separate_meta = __( ', ', 'bs4' );

		// Get Categories for posts.
		$categories_list = get_the_category_list( $separate_meta );

		// Get Tags for posts.
		$tags_list = get_the_tag_list( '', $separate_meta );

		// We don't want to output .entry-footer if it will be empty, so make sure its not.
		if ( ( ( bs4_categorized_blog() && $categories_list ) || $tags_list ) || get_edit_post_link() ) {

			echo '<footer class="entry-footer">';

				if ( 'post' === get_post_type() ) {
					if ( ( $categories_list && bs4_categorized_blog() ) || $tags_list ) {
						echo '<span class="cat-tags-links">';

							// Make sure there's more than one category before displaying.
							if ( $categories_list && bs4_categorized_blog() ) {
								echo '<span class="cat-links"><span class="screen-reader-text">' . __( 'Categories', 'bs4' ) . '</span>' . $categories_list . '</span>';
							}

							if ( $tags_list ) {
								echo '<span class="tags-links"><span class="screen-reader-text">' . __( 'Tags', 'bs4' ) . '</span>' . $tags_list . '</span>';
							}

						echo '</span>';
					}
				}

				bs4_edit_link();

			echo '</footer> <!-- .entry-footer -->';
		}
	}
}


if ( ! function_exists( 'bs4_edit_link' ) ) {
	/**
	 * Returns an accessibility-friendly link to edit a post or page.
	 *
	 * This also gives us a little context about what exactly we're editing
	 * (post or page?) so that users understand a bit more where they are in terms
	 * of the template hierarchy and their content. Helpful when/if the single-page
	 * layout with multiple posts/pages shown gets confusing.
	 */
	function bs4_edit_link() {

		$link = edit_post_link(
			sprintf(
				/* translators: %s: Name of current post */
				__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'bs4' ),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);

		return $link;
	}
}

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function bs4_categorized_blog() {
	$category_count = get_transient( 'bs4_categories' );

	if ( false === $category_count ) {
		// Create an array of all the categories that are attached to posts.
		$categories = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$category_count = count( $categories );

		set_transient( 'bs4_categories', $category_count );
	}

	return $category_count > 1;
}

/**
 * Template/display for comments and pingbacks. A callback for wp_list_comments().
 *
 * @link   https://codex.wordpress.org/Function_Reference/wp_list_comments
 * @since  0.1.0
 *
 * @param  object  $comment  comment data
 * @param  array   $args     all comments loop data
 * @param  string  $depth    comment depth in thread
 */
if ( ! function_exists( 'bs4_comment_list' ) ) {
	function bs4_comment_list( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment; ?>
		<div <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
            <div class="row">
                <div class="col-sm-2 hidden-xs-down comment-author-avatar">
					<?php echo get_avatar( $comment, 96, '', false, array( 'class' => 'img-fluid' ) ); ?>
				</div>
                <div class="col-sm-10">
        	        <div class="comment-content card">
                        <div class="card-block">
							<?php if ( $comment->comment_approved == '0' ) { ?>
            	                <em><?php _e( 'Your comment is awaiting moderation.', 'bs4' ); ?></em>
            	            <?php } ?>
            	            <h6 class="comment-author">
								<?php comment_author(); ?>
								<small class="comment-date text-muted">
									<i class="fa fa-clock-o"></i> <?php echo get_comment_date() . ' ' . get_comment_time(); ?>
								</small>
							</h6>
            	            <div class="comment-content-text">
								<?php comment_text(); ?>
							</div>
            	            <div class="comment-content-meta">
								<ul class="list-inline mb-0">
									<?php
										comment_reply_link(
											array_merge(
												$args,
												[
													'reply_text' => '<i class="fa fa-comment"></i> ' . __( 'Reply', 'bs4' ),
													'before' => '<li class="list-inline-item reply"><small>',
													'after' => '</small></li>',
													'depth' => $depth,
													'max_depth' => $args['max_depth']
												]
											)
										);

										edit_comment_link(
											'<i class="fa fa-pencil-square-o"></i> ' . __( 'Edit', 'bs4' ),
											'<li class="list-inline-item edit-link"><small>',
											'</small></li>'
										);
									?>
								</ul>
            	            </div>
                        </div>
                    </div>
                </div>
            </div>
		</div><?php
	}
}

/**
 * Flush out the transients used in bs4_categorized_blog.
 */
function bs4_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'bs4_categories' );
}
add_action( 'edit_category', 'bs4_category_transient_flusher' );
add_action( 'save_post',     'bs4_category_transient_flusher' );
