<?php
/**
 * Displays top navigation
 *
 * @package WordPress
 * @subpackage Bootstrap_4
 * @since 1.0
 * @version 1.0
 */

?><nav id="site-navigation" <?php bs4_navbar_class(); ?> role="navigation">
	<?php do_action( 'open_top_nav' ); ?>
		<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#primaryNavCollapse" aria-controls="primaryNavCollapse" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo( 'description' ); ?>" rel="home" class="navbar-brand">
			<?php bloginfo( 'name' ); ?>
		</a>
		<div class="collapse navbar-collapse" id="primaryNavCollapse">
			<div id="nav-main" class="collapse navbar-collapse main-menu-collapse" role="navigation">
				<?php
				wp_nav_menu( [
					'theme_location'  => 'top',
					'menu_id' 		  => 'top-menu',
					'container' 	  => false,
					'menu_class' 	  => 'nav navbar-nav',
					'walker' 	      => new BS4_Walker_Nav_Menu()
				] );
				?>
				<?php get_template_part( 'template-parts/navigation/navigation', 'search' ); ?>
			</div>
		</div>
	<?php do_action( 'close_top_nav' ); ?>
</nav><!-- #site-navigation -->
