<?php
/**
 * Template part for displaying posts with excerpts
 *
 * Used in Search Results and for Recent Posts in Front Page panels.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package     WordPress
 * @subpackage  Bootstrap_4
 * @since       1.0
 * @version     1.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="card">
		<div class="card-block">
			<header class="entry-header">
				<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
				<div class="entry-meta">
					<?php
					echo bs4_time_link();
					bs4_edit_link();
					?>
				</div><!-- .entry-meta -->
			</header><!-- .entry-header -->
			<div class="entry-summary"><?php the_excerpt(); ?></div><!-- .entry-summary -->
		</div>
	</div>
</article><!-- #post-## -->
