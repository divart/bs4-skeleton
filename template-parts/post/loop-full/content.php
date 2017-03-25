<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Bootstrap_4
 * @since 1.0
 * @version 1.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		the_title( '<h2 class="entry-title">', '</h2>' );
		echo '<div class="entry-meta">';
			echo bs4_time_link();
			bs4_edit_link();
		echo '</div><!-- .entry-meta -->';
		?>
	</header><!-- .entry-header -->
	<div class="entry-content">
		<?php
		/* translators: %s: Name of current post */
		the_content( sprintf(
			__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'bs4' ),
			get_the_title()
		) );
		wp_link_pages( array(
			'before'      => '<div class="page-links">' . __( 'Pages:', 'bs4' ),
			'after'       => '</div>',
			'link_before' => '<span class="page-number">',
			'link_after'  => '</span>',
		) );
		?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
