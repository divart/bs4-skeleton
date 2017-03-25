<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop, $firmasite_settings;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
//if ( empty( $woocommerce_loop['columns'] ) )
	//$woocommerce_loop['columns'] = apply_filters('loop_shop_columns', $firmasite_settings['loop_col']);

// Ensure visibility
if ( ! $product->is_visible() )
	return;

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
$classes[] = 'col-xs-12 col-sm-'.round(12 / $woocommerce_loop['columns']). ' col-md-'.round(12 / $woocommerce_loop['columns']). ' loop_tile_item';

?>
<article id="post-<?php the_ID(); ?>" <?php post_class("loop_excerpt"); ?>>
 <div class="panel panel-default">
   <div class="panel-body">
	<?php if ( has_post_thumbnail() ) { ?>
	<div class="entry-thumbnail col-xs-4 col-md-4 pull-left fs-content-thumbnail">
		<a href="<?php the_permalink(); ?>" class="thumbnail">
		<?php
			/**
			 * woocommerce_before_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 * @hooked woocommerce_template_loop_product_thumbnail - 10
			 */
			do_action( 'woocommerce_before_shop_loop_item_title' );
		?>
        </a>
	</div>
	<?php } ?>
    <div class="fs-have-thumbnail">
        <header class="entry-header">
            <h4 class="entry-title"><strong><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'bs4' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></strong></h4>
        </header>
        <div class="entry-content">
		<?php
			/**
			 * woocommerce_after_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_template_loop_price - 10
			 */
			do_action( 'woocommerce_after_shop_loop_item_title' );
		?>

		<?php

            /**
             * woocommerce_after_shop_loop_item hook
             *
             * @hooked woocommerce_template_loop_add_to_cart - 10
             */
            do_action( 'woocommerce_after_shop_loop_item' );

        ?>
        <?php echo woocommerce_show_product_loop_sale_flash(); ?>

            <?php
            if ( !preg_match('/<!--more(.*?)?-->/', $post->post_content) ){
                echo apply_filters( 'woocommerce_short_description', $post->post_excerpt );
            } else {
                the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'bs4' ) );
            }
             ?>
            <?php wp_link_pages( array( 'before' => '<div class="page-links"><ul class="pagination pagination-sm"><li><span>' . __( 'Pages:', 'bs4' ) . '</span></li>', 'after' => '</ul></div>','link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
            <?php if (empty($post->post_title)){ ?>
            <a class="pull-right" href="<?php the_permalink(); ?>" rel="bookmark">
                <small><i class="icon-bookmark"></i><?php  _e( 'Permalink', 'bs4' ); ?></small>
            </a>
            <?php } ?>
	         <?php edit_post_link( __( 'Edit', 'bs4' ), ' | <span class="edit-link"><span class="glyphicon glyphicon-edit"></span> ', '</span>' ); ?>
       </div>
        <?php woocommerce_get_template( 'templates/product/loop_excerpt/meta.php' ); ?>
		<div class="clearfix"></div>

    </div>
   </div>
 </div>
</article><!-- #post-<?php the_ID(); ?> -->
