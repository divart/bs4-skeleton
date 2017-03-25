<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Bootstrap_4
 * @since 1.0
 * @version 1.0
 */

if ( bs4_option( 'loop_product' ) == 'loop-full' ) {
    get_template_part( 'template-parts/product/loop-full/content', get_post_format() );
} elseif ( bs4_option( 'loop_product' ) == 'loop-excerpt' ) {
    get_template_part( 'template-parts/product/loop-excerpt/content', get_post_format() );
} elseif ( bs4_option( 'loop_product' ) == 'loop-tile' ) {
    get_template_part( 'template-parts/product/loop-tile/content', get_post_format() );
} elseif ( bs4_option( 'loop_product' ) == 'loop-grid' ) {
    get_template_part( 'template-parts/product/loop-grid/content', get_post_format() );
}
