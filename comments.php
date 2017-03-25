<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Bootstrap_4
 * @since 1.0
 * @version 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				$comment_count = get_comments_number();
				$comments_title = sprintf( _n( '%s Reply', '%s Replies', $comment_count, 'bs4' ), $comment_count );
				echo $comments_title;
			?>
		</h2>

		<div class="comments-list">
			<?php
				wp_list_comments( array(
					'callback' 	  => 'bs4_comment_list',
					'short_ping'  => true,
					'reply_text'  => __( 'Reply', 'bs4' ),
				) );
			?>
		</div>

		<?php the_comments_pagination( array(
			'prev_text' => __( 'Previous', 'bs4' ),
			'next_text' => __( 'Next', 'bs4' ),
		) );

	endif; // Check for have_comments().

	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

		<p class="no-comments"><?php _e( 'Comments are closed.', 'bs4' ); ?></p>
		
	<?php
	endif;

	$comment_args = apply_filters( 'bs4_wp_comment_form_args', [
		'title_reply_before'   => '<h4 class="comment-title">',
		'title_reply_after'    => '</h4>',
		'comment_notes_before' => '',
		'comment_notes_after'  => '',
		'label_submit'         => 'Add Reply',
		'class_submit'         => 'btn btn-secondary btn-comment',
	] );

	comment_form( $comment_args );
	?>

</div><!-- #comments -->
