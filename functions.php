<?php
/**
 * Bootstrap 4 functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Bootstrap_4
 * @since 1.0
 */

/**
 * Bootstrap 4 only works in WordPress 4.7 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function bs4_setup() {
	/**
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/bs4
	 * If you're building a theme based on Bootstrap 4, use a find and replace
	 * to change 'bs4' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'bs4' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/**
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link  https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'bs4-thumbnail-avatar', 100, 100, true );

	// Set the default content width.
	$GLOBALS['content_width'] = 688;

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( [
		'top' => __( 'Top Menu', 'bs4' )
	] );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', [
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	] );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', [
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'audio',
	] );

	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo' );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add theme support for WooCommerce.
	 *
	 * @link   https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
	 * @since  1.0
	 */
	add_theme_support( 'woocommerce' );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, and column width.
 	 */
	add_editor_style( ['assets/css/editor-style.css', bs4_fonts_url()] );

	/**
	 * Set global variable defaults from starter-content, then make it filterable.
	 *
	 * @since  1.0
	 * @param  array $starter_content Array of starter content.
	 */
	global $bs4_defaults, $bs4_customizer_choices;

	$bs4_theme_defaults = [
		'layout' 		    => 'right-sidebar',
		'container_header'  => ['container'],
		'container_top_nav' => ['container'],
		'container_content'	=> ['container'],
		'container_footer' 	=> ['container'],
		'row_content'		=> ['row'],
		'row_loop'			=> ['row'],
		'row_footer'		=> ['row'],
		'col_primary' 		=> ['col-md-8'],
		'col_secondary' 	=> ['col-md-4'],
		'col_loop_post'	    => ['col-md-4'],
		'col_loop_product'  => ['col-md-4'],
		'col_footer_widget' => ['col-md-4'],
		'loop_post'		    => 'loop-full',
		'loop_product'	    => 'loop-tile',
		'top_nav_placement' => ['fixed-top'],
		'top_nav_color'	    => ['navbar-inverse', 'bg-primary'],
		'top_nav_search'    => ['ml-auto'],
		'template'		    => 'cosmo'
	];

	$bs4_defaults = wp_parse_args( get_theme_mods(), $bs4_theme_defaults );
	$bs4_defaults = apply_filters( 'bs4_defaults', $bs4_defaults );

	$bs4_customizer_choices = bs4_get_global_customizer_choices();

	/**
	 * Set global variable defaults from starter-content, then make it filterable.
	 *
	 * @since  1.0
	 * @param  array $starter_content Array of starter content.
	 */
	$starter_content = apply_filters( 'bs4_starter_content_args', ['theme_mods' => $bs4_theme_defaults] );

	/**
	 * Add theme support for starter content
	 *
	 * @since  1.0
	 * @link   https://make.wordpress.org/core/2016/11/30/starter-content-for-themes-in-4-7/
	 * @param  array $starter_content Array of starter content.
	 */
	add_theme_support( 'starter-content', $starter_content );
}
add_action( 'after_setup_theme', 'bs4_setup' );

/**
 * Helper function to check if array is associative or sequential
 *
 * @link   http://stackoverflow.com/a/173479
 * @since  1.0
 * @return Return true if array is associative, else false.
 */
function bs4_is_associative_array( array $arr ) {
    if ( [] === $arr ) {
		return false;
	}
	return array_keys($arr) !== range(0, count($arr) - 1);
}

/**
 * Set theme defaults with global variable: $bs4_customizer_choices.
 *
 * @since  1.0
 */
function bs4_get_global_customizer_choices() {
	$bs4_customizer_choices = [
		'layout'		    => [
			'right-sidebar' => __( 'Right Sidebar', 'bs4' ),
			'left-sidebar'  => __( 'Left Sidebar' ),
			'no-sidebars'   => __( 'No Sidebar', 'bs4' )
		],
		'navbar_placement'	=> [
			'mr-auto',
			'ml-auto',
			'fixed-top',
			'fixed-bottom',
			'sticky-top'
		],
		'top_container'	=> [
			'none',
			'container',
			'container-fluid'
		],
		'navbar_container'	=> [
			'none',
			'container',
			'container-fluid'
		],
		'navbar_colors'     => [
			'navbar-inverse',
			'navbar-light',
			'bg-primary',
			'bg-success',
			'bg-info',
			'bg-warning',
			'bg-danger',
			'bg-inverse',
			'bg-faded'
		],
		'navbar_search'     => [
			'mr-auto',
			'ml-auto'
		],
		'col_classes'      => [
			'col-xs-1',
			'col-xs-2',
			'col-xs-3',
			'col-xs-4',
			'col-xs-5',
			'col-xs-6',
			'col-xs-7',
			'col-xs-8',
			'col-xs-9',
			'col-xs-10',
			'col-xs-11',
			'col-xs-12',
			'col-sm-1',
			'col-sm-2',
			'col-sm-3',
			'col-sm-4',
			'col-sm-5',
			'col-sm-6',
			'col-sm-7',
			'col-sm-8',
			'col-sm-9',
			'col-sm-10',
			'col-sm-11',
			'col-sm-12',
			'col-md-1',
			'col-md-2',
			'col-md-3',
			'col-md-4',
			'col-md-5',
			'col-md-6',
			'col-md-7',
			'col-md-8',
			'col-md-9',
			'col-md-10',
			'col-md-11',
			'col-md-12',
			'col-lg-1',
			'col-lg-2',
			'col-lg-3',
			'col-lg-4',
			'col-lg-5',
			'col-lg-6',
			'col-lg-7',
			'col-lg-8',
			'col-lg-9',
			'col-lg-10',
			'col-lg-11',
			'col-lg-12',
		],
		'loop_types'		=> [
			'loop-full'     => __( 'Full Post', 'bs4' ),
			'loop-excerpt'  => __( 'Excerpt', 'bs4' ),
			'loop-tile' 	=> __( 'Tile', 'bs4' ),
			'loop-grid'     => __( 'Grid', 'bs4' ),
		],
		'templates'		    => [
			'bootstrap',
			'cerulean',
			'cosmo',
			'cyborg',
			'darkly',
			'flatly',
			'journal',
			'litera',
			'lumen',
			'lux',
			'materia',
			'minty',
			'pulse',
			'sandstone',
			'simplex',
			'slate',
			'solar',
			'spacelab',
			'superhero',
			'united',
			'yeti'
		]
	];
	return apply_filters( 'bs4_global_customizer_choices', $bs4_customizer_choices );
}

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global  int $content_width
 */
function bs4_content_width() {
	global $bs4_defaults;

	$content_width = $GLOBALS['content_width'];
	// Get layout.
	$page_layout = bs4_option( 'layout' );

	// Check if layout is one column.
	if ( 'no-sidebars' === $page_layout ) {
		$content_width = 1110;
	} else {
		$content_width = 688;
	}

	// Check if is single post and there is no sidebar.
	if ( ! is_active_sidebar( 'secondary' ) ) {
		$content_width = 1110;
	}

	/**
	 * Filter Bootstrap 4 content width of the theme.
	 *
	 * @since  Bootstrap 4 1.0
	 *
	 * @param  $content_width integer
	 */
	$GLOBALS['content_width'] = apply_filters( 'bs4_content_width', $content_width );
}
add_action( 'template_redirect', 'bs4_content_width', 0 );

/**
 * Register custom fonts.
 */
function bs4_fonts_url() {
	$fonts_url = '';
	/**
	 * Translators: If there are characters in your language that are not
	 * supported by Libre Franklin, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$libre_franklin = _x( 'on', 'Libre Franklin font: on or off', 'bs4' );

	if ( 'off' !== $libre_franklin ) {

		$font_families = [];
		$font_families[] = 'Libre Franklin:300,300i,400,400i,600,600i,800,800i';
		$query_args = [
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		];
		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );

	}

	return esc_url_raw( $fonts_url );
}

/**
 * Add preconnect for Google Fonts.
 *
 * @since  Bootstrap 4 1.0
 *
 * @param  array  $urls           URLs to print for resource hints.
 * @param  string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function bs4_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'bs4-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = [
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		];
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'bs4_resource_hints', 10, 2 );

/**
 * Register widget area.
 *
 * @link   https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 * @since  1.0
 */
function bs4_widgets_init() {
	register_sidebar( [
		'name'          => __( 'Sidebar', 'bs4' ),
		'id'            => 'secondary',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'bs4' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	] );

	$bs4_col_footer_widget = join( ' ', bs4_get_column_class( 'col_footer_widget', 'col_footer_widget' ) );
	register_sidebar( [
		'name'          => __( 'Footer', 'bs4' ),
		'id'            => 'footer',
		'description'   => __( 'Add widgets here to appear in your footer.', 'bs4' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s ' . $bs4_col_footer_widget . '">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	] );
}
add_action( 'widgets_init', 'bs4_widgets_init' );

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and 'Continue reading' link.
 *
 * @since Bootstrap 4 1.0
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function bs4_excerpt_more( $link ) {

	if ( is_admin() ) {
		return $link;
	}

	$link = sprintf(
		'<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'bs4' ), get_the_title( get_the_ID() ) )
	);
	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'bs4_excerpt_more' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function bs4_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
	}
}
add_action( 'wp_head', 'bs4_pingback_header' );

/**
 * Enqueue scripts and styles.
 */
function bs4_scripts() {
	global $bs4_defaults;

	wp_enqueue_style( 'tether', get_theme_file_uri( '/assets/css/tether.min.css' ) );
	wp_enqueue_style( 'bootstrap-4', bs4_template_stylesheet() );

	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'bs4-fonts', bs4_fonts_url(), [], NULL );

	// If loop-tile active then register Masonry jQuery library.
	if ( ! is_singular() && ( bs4_option( 'loop_post' ) == 'loop-tile' || bs4_option( 'loop_product' ) == 'loop-tile' ) ) {
		wp_enqueue_script( 'jquery-masonry' );
	}

	wp_enqueue_style( 'font-awesome', get_theme_file_uri( '/assets/css/font-awesome.min.css' ), false );

	// Theme stylesheet.
	wp_enqueue_style( 'bs4-style', get_stylesheet_uri() );

	// Load the Internet Explorer 9 specific stylesheet, to fix display issues in the Customizer.
	if ( is_customize_preview() ) {

		wp_enqueue_style( 'bs4-ie9', get_theme_file_uri( '/assets/css/ie9.css' ), ['bs4-style'], '1.0' );
		wp_style_add_data( 'bs4-ie9', 'conditional', 'IE 9' );

	}

	// Load the Internet Explorer 8 specific stylesheet.
	wp_enqueue_style( 'bs4-ie8', get_theme_file_uri( '/assets/css/ie8.css' ), ['bs4-style'], '1.0' );
	wp_style_add_data( 'bs4-ie8', 'conditional', 'lt IE 9' );

	// Load the html5 shiv.
	wp_enqueue_script( 'html5', get_theme_file_uri( '/assets/js/html5.js' ), [], '3.7.3' );
	wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'bs4-skip-link-focus-fix', get_theme_file_uri( '/assets/js/skip-link-focus-fix.js' ), [], '1.0', true );

	$bs4_l10n = [];

	if ( has_nav_menu( 'top' ) ) {

		$bs4_l10n['expand']   = __( 'Expand child menu', 'bs4' );
		$bs4_l10n['collapse'] = __( 'Collapse child menu', 'bs4' );

	}

	wp_enqueue_script( 'tether', get_theme_file_uri( '/assets/js/tether.min.js' ), ['jquery'], false, true );
	wp_enqueue_script( 'bootstrap-4', get_theme_file_uri( '/assets/js/bootstrap.min.js' ), ['jquery'], false, true );

	/**
	 * Remove default Woocommerce Stylesheet
	 *
	 * @return array Breadcrumb with new args.
	 * @link   https://docs.woocommerce.com/document/disable-the-default-stylesheet/
	 * @since  1.0
	 */
	if ( function_exists( 'is_woocommerce' ) ) {

		// Remove generator meta tag
		remove_action( 'wp_head', array( $GLOBALS['woocommerce'], 'generator' ) );

		// Dequeue scripts and styles
		if ( !is_woocommerce() && ! is_cart() && !is_checkout() ) {

			wp_dequeue_style( 'woocommerce_frontend_styles' );
			wp_dequeue_style( 'woocommerce_fancybox_styles' );
			wp_dequeue_style( 'woocommerce_chosen_styles' );
			wp_dequeue_style( 'woocommerce_prettyPhoto_css' );

		}

	}

	wp_enqueue_script( 'jquery-scrollto', get_theme_file_uri( '/assets/js/jquery.scrollTo.js' ), ['jquery'], '2.1.2', true );

	wp_localize_script( 'bs4-skip-link-focus-fix', 'bs4ScreenReaderText', $bs4_l10n );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' );
}
add_action( 'wp_enqueue_scripts', 'bs4_scripts' );

/**
 * Add jQuery Masonry script to footer if 'loop-tile' is activated and not single template.
 *
 * @link  http://masonry.desandro.com/extras.html#bootstrap
 * @since 1.0
 */
function register_loop_tile_script() {

    if ( ! is_singular() && ( bs4_option( 'loop_post' ) == 'loop-tile' || bs4_option( 'loop_product' ) == 'loop-tile' ) ) {

		?><script type="text/javascript">
	        (function($) {
	            'use strict';
	            $(function() {
					var $tiles = $('#loop-tile').imagesLoaded( function() {
						$tiles.masonry({
	                        itemSelector: '.loop-tile',
	                        columnWidth: '.tile-sizer',
	                        percentPosition: true
	                    });
					});
	            });
	        })(jQuery);
        </script><?php

	}

}
add_action( 'wp_footer', 'register_loop_tile_script', 900 );

/**
 * Filter the `sizes` value in the header image markup.
 *
 * @since Bootstrap 4 1.0
 *
 * @param string $html   The HTML image tag markup being filtered.
 * @param object $header The custom header object returned by 'get_custom_header()'.
 * @param array  $attr   Array of the attributes for the image tag.
 * @return string The filtered header image HTML.
 */
function bs4_header_image_tag( $html, $header, $attr ) {

	if ( isset( $attr['sizes'] ) ) $html = str_replace( $attr['sizes'], '100vw', $html );

	return $html;
}
add_filter( 'get_header_image_tag', 'bs4_header_image_tag', 10, 3 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails.
 *
 * @since Bootstrap 4 1.0
 *
 * @param array $attr       Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size       Registered image size or flat array of height and width dimensions.
 * @return string A source size value for use in a post thumbnail 'sizes' attribute.
 */
function bs4_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {

	if ( is_archive() || is_search() || is_home() ) $attr['sizes'] = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
	else $attr['sizes'] = '100vw';

	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'bs4_post_thumbnail_sizes_attr', 10, 3 );

/**
 * Inline stylesheet for conditional CSS.
 *
 * @since  0.1.0
 */
function inline_theme_conditional_stylesheet() {
	global $bs4_defaults;

	$placement_classes = bs4_option( 'top_nav_placement' );

	if ( $placement_classes && in_array( 'fixed-top', $placement_classes ) ) {

		$fixed_nav_css = 'body{margin-top:90px}';

		if ( is_user_logged_in() && !is_customize_preview() ) {

			$fixed_nav_css .= 'nav.fixed-top{top:32px !important} @media screen and (max-width: 782px) { nav.fixed-top{top:46px !important} } @media screen and (max-width: 600px) { nav.fixed-top{top:0 !important} }';

		}

	}

	?><style type="text/css"><?php echo $fixed_nav_css; ?></style><?php
}
add_action( 'wp_head', 'inline_theme_conditional_stylesheet', 100 );

/**
 * Fix for custom menu widget.
 *
 * @link   http://wordpress.stackexchange.com/questions/53950/add-a-custom-walkter-to-a-menu-created-in-a-widget
 * @since  0.1.0
 *
 * @param  array $args
 * @return array
 */
function bs4_wp_widget_custom_menu_html( $args ) {
	global $bs4_defaults;

	if ( ! isset( $bs4_defaults['menu_locations'] ) ) {

		$menu_locations = get_registered_nav_menus();

		foreach ( $menu_locations as $menu_id => $menu_name ) {

			$bs4_defaults['menu_locations'][] = $menu_id;

		}

	}

	if ( !in_array( $args['theme_location'], $bs4_defaults['menu_locations'] ) ) {
		return array_merge( $args, array(
			'menu_class' => 'nav flex-column nav-pills',
			'walker' 	 => new BS4_Walker_Nav_Menu(),
		) );
	} else {
		return $args;
	}

}
add_filter( 'wp_nav_menu_args', 'bs4_wp_widget_custom_menu_html' );

/**
 * Display left sidebar
 *
 * bs4_before_content_add_container_open - 20
 * bs4_display_left_sidebar - 40
 * bs4_open_content_primary_open - 60
 *
 * @since  1.0
 */
function bs4_display_left_sidebar() {
	if ( bs4_option( 'layout' ) == 'left-sidebar' ) {
		get_sidebar();
	}
}
add_action( 'open_content', 'bs4_display_left_sidebar', 40 );

/**
 * Display right sidebar
 *
 * @since  1.0
 */
function bs4_display_right_sidebar() {
	if ( bs4_option( 'layout' ) == 'right-sidebar' ) {
		get_sidebar();
	}
}
add_action( 'close_content', 'bs4_display_right_sidebar', 80 );

/**
 * Top navbar container open
 *
 * @since  1.0
 */
function open_top_nav_container() {
	?><div <?php bs4_container_class( 'container_top_nav', 'container_top_nav' ); ?>><?php
}
add_action( 'open_top_nav', 'open_top_nav_container', 900 );

/**
 * Top navbar container close
 *
 * @since  1.0
 */
function close_top_nav_container() {
	?></div><?php
}
add_action( 'close_top_nav', 'close_top_nav_container', 1 );

/**
 * Add header navigation before content (before_content)
 *
 * @since  1.0
 */
function bs4_before_content_add_header() {
	?><header id="masthead" class="site-header" role="banner">

		<?php if ( has_nav_menu( 'top' ) ) {
			get_template_part( 'template-parts/navigation/navigation', 'top' );
		} ?>

	</header><?php
}
add_action( 'before_content', 'bs4_before_content_add_header', 20 );

/**
 * Open #main for HTML5
 *
 * @since  1.0
 */
function bs4_open_content_main_open() {
	?><main id="main" class="site-main" role="main"><?php
}
add_action( 'before_content', 'bs4_open_content_main_open', 60 );

/**
 * Close #main for HTML5
 *
 * @since  1.0
 */
function bs4_close_content_main_close() {
	?></main><?php
}
add_action( 'after_content', 'bs4_close_content_main_close', 60 );

/**
 * Open Bootstrap container around content.
 *
 * bs4_before_content_add_container_open - 20
 * bs4_display_left_sidebar - 40
 * bs4_open_content_primary_open - 60
 *
 * @since  1.0
 */
function bs4_before_content_add_container_open() {
	?><div <?php bs4_container_class( 'container_content', 'container_content' ); ?>>
		<div id="content" <?php bs4_row_class( 'row_content', 'row_content' ); ?>><?php
}
add_action( 'open_content', 'bs4_before_content_add_container_open', 20 );

/**
 * Close Bootstrap container around content.
 *
 * @since  1.0
 */
function bs4_after_content_add_container_close() {
		?></div>
	</div><?php
}
add_action( 'after_content', 'bs4_after_content_add_container_close', 40 );

/**
 * Open Bootstrap column, loop title, and #main.
 *
 * bs4_before_content_add_container_open - 20
 * bs4_display_left_sidebar - 40
 * bs4_open_content_primary_open - 60
 *
 * @since  1.0
 */
function bs4_open_content_primary_open() {
	?><div id="primary" <?php bs4_column_class( 'col_primary', 'content-area col_primary' ); ?>><?php
}
add_action( 'open_content', 'bs4_open_content_primary_open', 60 );

/**
 * Close #main and Bootstrap column.
 *
 * @since  1.0
 */
function bs4_close_content_primary_close() {
	?></div><?php
}
add_action( 'close_content', 'bs4_close_content_primary_close', 60 );

/**
 * Open Bootstrap 'card' wrapper around content.
 *
 * @since  1.0
 */
function bs4_content_card_display_open() {
	?><div class="card open_loop-card">
		<div class="card-block"><?php
}
add_action( 'open_single', 'bs4_content_card_display_open', 90 );

/**
 * Close Bootstrap 'card' wrapper around content.
 *
 * @since  1.0
 */
function bs4_content_card_display_close() {
		?></div>
	</div><?php
}
add_action( 'close_single', 'bs4_content_card_display_close', 90 );

/**
 * At WooCommerce loop open add wrapper and resizer column for jQuery Masonry.
 *
 * @link   http://masonry.desandro.com/extras.html#bootstrap
 * @since  1.0
 */
function bs4_open_loop_row() {
	if ( bs4_option( 'loop_post' ) == 'loop-tile' || bs4_option( 'loop_post' ) == 'loop-grid' ) {
		echo '<div id="' . bs4_option( 'loop_post' ) . '"' . bs4_row_class( 'row_loop', 'row_loop', false ) . '>';
 	} else {
		echo '<div id="' . bs4_option( 'loop_post' ) . '">';
	}
}
add_action( 'open_loop_post', 'bs4_open_loop_row', 60 );


function bs4_open_loop_post_masonry() {
	if ( bs4_option( 'loop_post' ) == 'loop-tile' ) {
		echo '<div class="tile-sizer ' . bs4_option( 'col_loop_post', 'col_loop_post' ) . '"></div>';
	}
}
add_action( 'open_loop_post', 'bs4_open_loop_post_masonry', 70 );

/**
 * Close WooCommerce loop jQuery Masonry wrapper.
 *
 * @link   http://masonry.desandro.com/extras.html#bootstrap
 * @since  1.0
 */
function bs4_close_loop_post() {
	?></div><?php
}
add_action( 'close_loop_post', 'bs4_close_loop_post', 60 );

/**
 * Close WooCommerce loop jQuery Masonry wrapper.
 *
 * @link   http://masonry.desandro.com/extras.html#bootstrap
 * @since  1.0
 */
function bs4_close_loop_product() {
	?></div><?php
}
add_action( 'close_loop_product', 'bs4_close_loop_product', 60 );

/**
 * Custom plugins for this theme if activated.
 */
require get_parent_theme_file_path( '/inc/plugins.php' );

/**
 * Custom template tags for this theme.
 */
require get_parent_theme_file_path( '/inc/template-tags.php' );

/**
 * Additional features to allow styling of the templates.
 */
require get_parent_theme_file_path( '/inc/template-functions.php' );

/**
 * Customizer additions.
 */
require get_parent_theme_file_path( '/inc/customizer.php' );
