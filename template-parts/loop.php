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

/*
 * Include the Post-Format-specific template for the content.
 * If you want to override this in a child theme, then include a file
 * called content-___.php (where ___ is the Post Format) and that will be used instead.
 */
global $bs4_defaults;

if ( bs4_option( 'loop_post' ) == 'loop-full' )
    get_template_part( 'template-parts/post/loop-full/content', get_post_format() );
elseif ( bs4_option( 'loop_post' ) == 'loop-excerpt' )
    get_template_part( 'template-parts/post/loop-excerpt/content', get_post_format() );
elseif ( bs4_option( 'loop_post' ) == 'loop-tile' )
    get_template_part( 'template-parts/post/loop-tile/content', get_post_format() );
elseif ( bs4_option( 'loop_post' ) == 'loop-grid' )
    get_template_part( 'template-parts/post/loop-grid/content', get_post_format() );
