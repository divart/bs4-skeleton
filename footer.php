<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Bootstrap_4
 * @since 1.0
 * @version 1.0
 */

?>

		</div><!-- #content -->

		<?php do_action( 'after_content' ); ?>

		<footer id="colophon" class="site-footer" role="contentinfo">
			<div <?php bs4_container_class( 'container_footer', 'container_footer' ); ?>>
				<?php get_template_part( 'template-parts/footer/footer', 'widgets' ); ?>

				<?php if ( has_nav_menu( 'social' ) ) : ?>

					<nav class="social-navigation" role="navigation" aria-label="<?php _e( 'Footer Social Links Menu', 'bs4' ); ?>">
						<?php wp_nav_menu( [
							'theme_location' => 'social',
							'menu_class'     => 'social-links-menu',
							'depth'          => 1,
							'link_before'    => '<span class="screen-reader-text">',
							'link_after'     => '</span>'
						] ); ?>
					</nav><!-- .social-navigation -->

				<?php endif; ?>

				<?php get_template_part( 'template-parts/footer/site', 'info' ); ?>
			</div>
		</footer><!-- #colophon -->
	</div><!-- .site-content-contain -->
</div><!-- #page -->
<?php wp_footer(); ?>

</body>
</html>
