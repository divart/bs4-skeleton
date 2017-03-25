<?php
/**
 * @package bs4-wp
 */
 ?>
<header class="entry-header">
    <h1 class="page-header page-title entry-title">
        <?php the_title(); ?>
		<?php
		$paged = (get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
		if ( 1 < $paged ) echo "<small> - " . sprintf(__( "%s. page", 'bs4' ), $paged ) . "</small>";
        ?>
    </h1>
</header>
<div class="entry-content">
	<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'bs4' ) ); ?>
    <?php wp_link_pages( array( 'before' => '<div class="page-links"><ul class="pagination pagination-sm">', 'after' => '</ul></div>' ) ); ?>
</div>
