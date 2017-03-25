<?php
/**
 * Additional features to allow styling of the templates
 *
 * @package WordPress
 * @subpackage Bootstrap_4
 * @since 1.0
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function bs4_body_classes( $classes ) {

	// Add class for user's browser
	global $post, $is_chrome, $is_safari, $is_NS4, $is_opera, $is_macIE, $is_winIE, $is_gecko, $is_lynx, $is_IE, $is_edge;
	$browsers = [
		'is_chrome' => $is_chrome,
		'is_safari' => $is_safari,
		'is_ns4' => $is_NS4,
		'is_opera' => $is_opera,
		'is_macIE' => $is_macIE,
		'is_winIE' => $is_winIE,
		'is_gecko' => $is_gecko,
		'is_lynx' => $is_lynx,
		'is_IE' => $is_IE,
		'is_edge' => $is_edge
	];

	foreach ( $browsers as $_name => $_val ) {
		if ( $_val == true ) {
			$classes[] = $_name;
		}
	}

	// Add class for page name
	if ( is_page() ) $classes[] = $post->post_name;

	// Add class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) $classes[] = 'group-blog';

	// Add class of hfeed to non-singular pages.
	if ( ! is_singular() ) $classes[] = 'hfeed';

	// Add class if we're viewing the Customizer for easier styling of theme options.
	if ( is_customize_preview() ) $classes[] = 'bs4-customizer';

	// Add class on front page.
	if ( is_front_page() && 'posts' !== get_option( 'show_on_front' ) ) $classes[] = 'bs4-front-page';

	// Add a class if there is a custom header.
	if ( has_header_image() ) $classes[] = 'has-header-image';

	// Add class if sidebar is used.
	if ( is_active_sidebar( 'secondary' ) && ! is_page() ) $classes[] = 'has-sidebar';

	// Remove 'tag' class from WordPress body_class because it interferes with Bootstrap 'tag' class.
	if ( is_tag() ) unset( $classes[1] );

	// Add class if the site title and tagline is hidden.
	if ( 'blank' === get_header_textcolor() ) $classes[] = 'title-tagline-hidden';

	return $classes;
}
add_filter( 'body_class', 'bs4_body_classes' );

function bs4_template_stylesheet() {
	$name = bs4_option( 'template' );
	return apply_filters( 'bs4_template_stylesheet', get_theme_file_uri( '/assets/css/templates/' . $name . '/bootstrap.min.css', $name ) );
}

function bs4_navbar_class( $class = '' ) {
	echo 'class="' . join( ' ', bs4_get_navbar_class( $class ) ) . '"';
}

function bs4_get_navbar_class( $class ) {
	$classes = [];

	if ( $class ) {

		if ( ! is_array( $class ) ) {

			$class = preg_split( '#\s+#', $class );

		}

		$classes = array_map( 'esc_attr', $class );

	} else {

		// Ensure that we always coerce class to being an array.
        $class = [];

	}

	$classes[] = 'navbar';
	$classes[] = 'navbar-toggleable-md';

	$color_classes = bs4_option( 'top_nav_color' );
	foreach ( $color_classes as $color_class ) $classes[] = $color_class;

	$placement_classes = bs4_option( 'top_nav_placement' );
	foreach ( $placement_classes as $placement_class ) $classes[] = $placement_class;

	$classes = apply_filters( 'bs4_navbar_class', $classes, $class );
	return array_flip(array_flip( $classes ) );
}

function bs4_column_class( $location = '', $class = '', $echo = true ) {
	if ( $echo == true ) echo 'class="' . join( ' ', bs4_get_column_class( $location, $class ) ) . '"';
	else return 'class="' . join( ' ', bs4_get_column_class( $location, $class ) ) . '"';
}

function bs4_get_column_class( $location, $class ) {
	$classes = [];

	if ( $class ) {

		if ( ! is_array( $class ) ) {

			$class = preg_split( '#\s+#', $class );

		}

		$classes = array_map( 'esc_attr', $class );

	} else {

        // Ensure that we always coerce class to being an array.
        $class = [];

	}

	if ( $location != '' ) {

		$__classes = bs4_option( $location );

		foreach ( $__classes as $__class ) {

			$classes[] = $__class;

		}

	}

	$classes = apply_filters( 'bs4_column_class', $classes, $class );
	return array_flip(array_flip( $classes ) );
}


function bs4_container_class( $location = '', $class = '' ) {
	echo 'class="' . join( ' ', bs4_get_container_class( $location, $class ) ) . '"';
}

function bs4_get_container_class( $location, $class ) {
	$classes = [];

	if ( $class ) {

		if ( ! is_array( $class ) ) {

			$class = preg_split( '#\s+#', $class );

		}

		$classes = array_map( 'esc_attr', $class );

	} else {

        // Ensure that we always coerce class to being an array.
        $class = [];

	}

	if ( $location != '' ) {

		$__classes = bs4_option( $location );

		foreach ( $__classes as $__class ) {

			$classes[] = $__class;

		}

	}

	$classes = apply_filters( 'bs4_container_class', $classes, $class );
	return array_flip(array_flip( $classes ) );
}


function bs4_row_class( $location = '', $class = '', $echo = true ) {
	if ( $echo == true ) echo 'class="' . join( ' ', bs4_get_row_class( $location, $class ) ) . '"';
	else return 'class="' . join( ' ', bs4_get_row_class( $location, $class ) ) . '"';
}

function bs4_get_row_class( $location, $class ) {
	$classes = [];

	if ( $class ) {

		if ( ! is_array( $class ) ) {

			$class = preg_split( '#\s+#', $class );

		}

		$classes = array_map( 'esc_attr', $class );

	} else {

        // Ensure that we always coerce class to being an array.
        $class = [];

	}

	if ( $location != '' ) {

		$__classes = bs4_option( $location );

		foreach ( $__classes as $__class ) {

			$classes[] = $__class;

		}

	}

	$classes = apply_filters( 'bs4_row_class', $classes, $class );
	return array_flip(array_flip( $classes ) );
}


function bs4_form_class( $location = '', $class = '' ) {
	echo 'class="' . join( ' ', bs4_get_form_class( $location, $class ) ) . '"';
}

function bs4_get_form_class( $location, $class ) {
	$classes = [];

	if ( $class ) {

		if ( ! is_array( $class ) ) {

			$class = preg_split( '#\s+#', $class );

		}

		$classes = array_map( 'esc_attr', $class );

	} else {

        // Ensure that we always coerce class to being an array.
        $class = [];

	}

	if ( $location != '' ) {

		$__classes = bs4_option( $location );

		foreach ( $__classes as $__class ) {

			$classes[] = $__class;

		}

	}

	$classes = apply_filters( 'bs4_form_class', $classes, $class );

	return array_flip(array_flip( $classes ) );
}


function bs4_products_row() {
	echo '<div id="' . bs4_option( 'loop_product' ) . '" ' . bs4_row_class( 'row_loop', 'row_loop' ) . '>';
}

/**
 * Helper function for displaying values from WordPress Customizer
 *
 * Merges global variable and get_theme_mod() so coding is less redundant.
 *
 * @since  0.1.0
 */
function bs4_option( $name = '' ) {
    global $bs4_defaults;
    $html = '';

    if ( $name  == '' ) return;

	$html = get_theme_mod( $name, $bs4_defaults[$name] );

    return $html;
}

/**
 * Custom walker class to make WordPress compatible with Bootstrap 4 nav.
 *
 * @since 1.0
 */
class BS4_Walker_Nav_Menu extends Walker_Nav_Menu {
    /**
     * Starts the list before the elements are added.
     *
     * Adds classes to the unordered list sub-menus.
     *
     * @param  string  $output  Passed by reference. Used to append additional content.
     * @param  int     $depth   Depth of menu item. Used for padding.
     * @param  array   $args    An array of arguments. @see wp_nav_menu()
     */
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        // Depth-dependent classes.
        $indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // This is for indenting.
        $display_depth = ( $depth + 1 ); // Needed because it counts the first submenu as 0.
        $classes = array(
            'sub-menu',
            ( $display_depth % 2  ? 'menu-odd': 'menu-even' ),
            ( $display_depth >= 2 ? 'sub-sub-menu': '' ),
            'menu-depth-' . $display_depth
        );
        $class_names = implode( ' ', $classes );
        // Build HTML for output.
        $output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
    }

    /**
     * Start the element output.
     *
     * Adds main/sub-classes to the list items and links.
     *
     * @param  string  $output  Passed by reference. Used to append additional content.
     * @param  object  $item    Menu item data object.
     * @param  int     $depth   Depth of menu item. Used for padding.
     * @param  array   $args    An array of arguments. @see wp_nav_menu()
     * @param  int     $id      Current item ID.
     */
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        global $wp_query;
        $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent
        // Depth-dependent classes.
        $depth_classes = array(
            ( $depth == 0 ? 'main-menu-item': 'sub-menu-item' ),
            ( $depth >= 2 ? 'sub-sub-menu-item': '' ),
            ( $depth % 2 ? 'menu-item-odd': 'menu-item-even' ),
            'menu-item-depth-' . $depth
        );
        $depth_class_names = esc_attr( implode( ' ', $depth_classes ) );
        // Passed classes.
        $classes = empty( $item->classes ) ? array() : ( array ) $item->classes;
		$active = in_array( 'current-menu-item', $item->classes ) ? 'active ' : '';
        $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );
        // Build HTML.
        $output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="nav-item ' . $active . $depth_class_names . ' ' . $class_names . '">';
        // Link attributes.
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) . '"': '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) . '"': '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) . '"': '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) . '"': '';
        $attributes .= ' class="nav-link ' . $active . ( $depth > 0 ? 'sub-menu-link': 'main-menu-link' ) . '"';
        // Build HTML output and pass through the proper filter.
        $item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
            $args->before,
            $attributes,
            $args->link_before,
            apply_filters( 'the_title', $item->title, $item->ID ),
            $args->link_after,
            $args->after
        );
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}

/**
 * Reposition comment form fields, make fields conditional, and make form Bootstrap-friendly.
 *
 * @since  0.1.0
 * @param  array  $fields  comment form fields
 * @link   https://developer.wordpress.org/reference/hooks/comment_form_fields/
 */
function bootstrap_friendly_comment_form( $fields ) {
    // Re-position comment textarea to bottom, WP default has it at the top of form.
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;

	// Remove default field: 'Website'
    unset( $fields['url'] );

    // set empty variables
    $fields['author']  = '';
    $fields['email']   = '';
    $fields['comment'] = '';

	$commenter 	  = wp_get_current_commenter();
	$_html5 	  = current_theme_supports( 'html5', 'comment-form' ) ? 1 : 0;
	$_input_email = ( $_html5 ? 'type="email"': 'type="text"' );
	$_input_url   = ( $_html5 ? 'type="url"': 'type="text"' );

    // HTML of comment form
    $fields['author'] .= '<div class="row">';
        $fields['author'] .= '<div class="col-sm-6">';
            $fields['author'] .= '<div class="form-group comment-form-author">';
                $fields['author'] .= '<label for="author">' . __( 'Name', 'bs4' ) . '<span class="required">*</span></label>';
                $fields['author'] .= '<input class="form-control" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" aria-required="true" />';
            $fields['author'] .= '</div>';
        $fields['author'] .= '</div>';

        $fields['email'] .= '<div class="col-sm-6">';
            $fields['email'] .= '<div class="form-group comment-form-email">';
                $fields['email'] .= '<label for="email">' . __( 'Email', 'bs4' ) . '<span class="required">*</span></label>';
                $fields['email'] .= '<input class="form-control" id="name" name="email" ' . $_input_email . ' value="' . esc_attr( $commenter['comment_author_email'] ) . '" aria-required="true" />';
            $fields['email'] .= '</div>';
        $fields['email'] .= '</div>';
    $fields['email'] .= '</div>'; // close "row"

    $fields['comment'] .= '<div class="form-group"><textarea id="comment" class="form-control" name="comment" rows="3" aria-required="true"></textarea></div>';

    return $fields;
}
add_filter( 'comment_form_fields', 'bootstrap_friendly_comment_form' );

/**
 * Make Bootstrap 4 WordPress pagination
 *
 * @since  1.0
 */
function bs4_pagination() {
    global $wp_query;
    $big = 999999999; // need an unlikely integer
    $pages = paginate_links( apply_filters( 'bs4_pagination_args', [
        'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
        'format'    => '?paged=%#%',
        'current'   => max( 1, get_query_var( 'paged' ) ),
        'total'     => $wp_query->max_num_pages,
        'prev_next' => false,
        'type'      => 'array',
        'prev_next' => true,
        'prev_text' => '<i class="fa fa-angle-left" aria-hidden="true"></i>',
        'next_text' => '<i class="fa fa-angle-right" aria-hidden="true"></i>',
    ] ) );
    $output = '';

    if ( is_array( $pages ) ) {

		$paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var( 'paged' );
        $output .=  '<ul class="pagination">';

			foreach ( $pages as $page ) {
	            $output .= '<li class="page-item">' . $page . '</li>';
	        }

		$output .= '</ul>';
		// Create an instance of DOMDocument
        $dom = new \DOMDocument();
        // Populate $dom with $output, making sure to handle UTF-8, otherwise problems will occur with UTF-8 characters.
        $dom->loadHTML( mb_convert_encoding( $output, 'HTML-ENTITIES', 'UTF-8' ) );
        // Create an instance of DOMXpath and all elements with the class 'page-numbers'
        $xpath = new \DOMXpath( $dom );
        // http://stackoverflow.com/a/26126336/3059883
        $page_numbers = $xpath->query( "//*[contains(concat(' ', normalize-space(@class), ' '), ' page-numbers ')]" );

        // Iterate over the $page_numbers node...
        foreach ( $page_numbers as $page_numbers_item ) {

            // Add class="mynewclass" to the <li> when its child contains the current item.
            $page_numbers_item_classes = explode( ' ', $page_numbers_item->attributes->item(0)->value );

			if ( in_array( 'current', $page_numbers_item_classes ) ) {

				$list_item_attr_class = $dom->createAttribute( 'class' );
                $list_item_attr_class->value = 'page-item';
			    $page_numbers_item->parentNode->appendChild( $list_item_attr_class );

			}

            // Replace the class 'current' with 'active'
            $page_numbers_item->attributes->item(0)->value = str_replace( 'current', 'active', $page_numbers_item->attributes->item(0)->value );

            // Replace the class 'page-numbers' with 'page-link'
            $page_numbers_item->attributes->item(0)->value = str_replace( 'page-numbers', 'page-link', $page_numbers_item->attributes->item(0)->value );
        }

        // Save the updated HTML and output it.
        $output = $dom->saveHTML();
    }

    echo $output;
}

/**
 * Custom breadcrumbs
 *
 * @since  1.0
 */

function bs4_breadcrumbs() {
	if ( ! ( is_home() || is_front_page() ) ) echo get_bs4_breadcrumbs();
}

function get_bs4_breadcrumbs() {
	$_args = apply_filters( 'bs4_pre_get_breadcrumb_args', [
		'wrapper_class' => 'breadcrumb theme-breadcrumb',
		'home_string' 	=> 'Home',
		'home_url'	  	=> home_url(),
	] );
    $breadcrumb = '<ol class="' . $_args['wrapper_class'] . '">';
	$crumb_home = apply_filters( 'bs4_breadcrumb_home_string', 'Home' );
    // Front page
    if ( is_front_page() ) $breadcrumb .= '<li class="breadcrumb-item">Home</li>';
    else $breadcrumb .= '<li class="breadcrumb-item"><a href="' . home_url() . '">Home</a></li>';
    // Blog archive
    if ( 'page' == get_option( 'show_on_front' ) && get_option( 'page_for_posts' ) ) {
        $blog_page_id = get_option( 'page_for_posts' );
        if ( is_home() ) {
            $breadcrumb .= '<li class="breadcrumb-item">' . get_the_title( $blog_page_id )  . '</li>';
        } elseif ( is_category() || is_tag() || is_author() || is_date() || is_singular( 'post' ) ) {
            $breadcrumb .= '<li class="breadcrumb-item"><a href="' . get_permalink( $blog_page_id ) . '">' . get_the_title( $blog_page_id )  . '</a></li>';
        }
    }
    // Category, tag, author and date archives
    if ( is_archive() && ! is_tax() && ! is_post_type_archive() ) {
        $breadcrumb .= '<li class="breadcrumb-item">';
        // Title of archive
        if ( is_category() ) {
            $breadcrumb .= single_cat_title( '', false );
        } elseif ( is_tag() ) {
            $breadcrumb .= single_tag_title( '', false );
        } elseif ( is_author() ) {
            $breadcrumb .= get_the_author();
        } elseif ( is_date() ) {
            if ( is_day() ) {
                $breadcrumb .= get_the_time( 'F j, Y' );
            } elseif ( is_month() ) {
                $breadcrumb .= get_the_time( 'F, Y' );
            } elseif ( is_year() ) {
                $breadcrumb .= get_the_time( 'Y' );
            }
        }
        $breadcrumb .= '</li>';
    }
    // Posts
    if ( is_singular( 'post' ) ) {
        // Post categories
        $post_cats = get_the_category();
        if ( $post_cats[0] ) {
            $breadcrumb .= '<li class="breadcrumb-item"><a href="' . get_category_link( $post_cats[0]->term_id ) . '">' . $post_cats[0]->name . '</a></li>';
        }
        // Post title
        $breadcrumb .= '<li class="breadcrumb-item">' . get_the_title() . '</li>';
    }
    // Pages
    if ( is_page() && ! is_front_page() ) {
        $post = get_post( get_the_ID() );
        // Page parents
        if ( $post->post_parent ) {
            $parent_id  = $post->post_parent;
            $crumbs = array();
            while ( $parent_id ) {
                $page = get_page( $parent_id );
                $crumbs[] = '<a href="' . get_permalink( $page->ID ) . '">' . get_the_title( $page->ID ) . '</a>';
                $parent_id  = $page->post_parent;
            }
            $crumbs = array_reverse( $crumbs );
            foreach ( $crumbs as $crumb ) {
                $breadcrumb .= '<li class="breadcrumb-item">' . $crumb . '</li>';
            }
        }
        // Page title
        $breadcrumb .=  '<li class="breadcrumb-item">' . get_the_title() . '</li>';
    }
    // Attachments
    if ( is_attachment() ) {
        // Attachment parent
        $post = get_post( get_the_ID() );
        if ( $post->post_parent ) {
            $breadcrumb .= '<li class="breadcrumb-item"><a href="' . get_permalink( $post->post_parent ) . '">' . get_the_title( $post->post_parent ) . '</a></li>';
        }
        // Attachment title
        $breadcrumb .= '<li class="breadcrumb-item">' . get_the_title() . '</li>';
    }
    // Search
    if ( is_search() ) $breadcrumb .= '<li class="breadcrumb-item">' . __( 'Search', 'bs4' ) . '</li>';
    // 404
    if ( is_404() ) $breadcrumb .= '<li class="breadcrumb-item">' . __( '404', 'bs4' ) . '</li>';
    // Custom Post Type Archive
	if ( is_post_type_archive() ) $breadcrumb .= '<li class="breadcrumb-item">' . post_type_archive_title( '', false ) . '</li>';
	// Custom Taxonomies
	if ( is_tax() ) {
		// Get the post types the taxonomy is attached to
		$current_term = get_queried_object();
		$attached_to = array();
		$post_types = get_post_types();
		foreach ( $post_types as $post_type ) {
			$taxonomies = get_object_taxonomies( $post_type );
			if ( in_array( $current_term->taxonomy, $taxonomies ) ) {
				$attached_to[] = $post_type;
			}
		}
		// Post type archive link
		$output = false;
		foreach ( $attached_to as $post_type ) {
			$cpt_obj = get_post_type_object( $post_type );
			if ( ! $output && get_post_type_archive_link( $cpt_obj->name ) ) {
				$breadcrumb .= '<li class="breadcrumb-item"><a href="' . get_post_type_archive_link( $cpt_obj->name ) . '">' . $cpt_obj->labels->name . '</a></li>';
				$output = true;
			}
		}
		// Term title
		$breadcrumb .= '<li class="breadcrumb-item">' . single_term_title( '', false ) . '</li>';
	}
	// Custom Post Types
	if ( is_single() && get_post_type() != 'post' && get_post_type() != 'attachment' ) {
		$cpt_obj = get_post_type_object( get_post_type() );
		// Is cpt hierarchical like pages or posts?
		if ( is_post_type_hierarchical( $cpt_obj->name ) ) {
			// Like pages
			// Cpt archive
			if ( get_post_type_archive_link( $cpt_obj->name ) ) {
				$breadcrumb .= '<li class="breadcrumb-item"><a href="' . get_post_type_archive_link( $cpt_obj->name ) . '">' . $cpt_obj->labels->name . '</a></li>';
			}
			// Cpt parents
			$post = get_post( get_the_ID() );
			if ( $post->post_parent ) {
				$parent_id  = $post->post_parent;
				$crumbs = array();
				while ( $parent_id ) {
					$page = get_page( $parent_id );
					$crumbs[] = '<a href="' . get_permalink( $page->ID ) . '">' . get_the_title( $page->ID ) . '</a>';
					$parent_id  = $page->post_parent;
				}
				$crumbs = array_reverse( $crumbs );
				foreach ( $crumbs as $crumb ) {
					$breadcrumb .= '<li>' . $crumb . '</li>';
				}
			}
		} else {
			// Like posts
			// Cpt archive
			if ( get_post_type_archive_link( $cpt_obj->name ) ) {
				$breadcrumb .= '<li class="breadcrumb-item"><a href="' . get_post_type_archive_link( $cpt_obj->name ) . '">' . $cpt_obj->labels->name . '</a></li>';
			}
			// Get cpt taxonomies
			$cpt_taxes = get_object_taxonomies( $cpt_obj->name );
			if ( $cpt_taxes && is_taxonomy_hierarchical( $cpt_taxes[0] ) ) {
				// Other taxes attached to the cpt could be hierachical, so need to look into that.
				$cpt_terms = get_the_terms( get_the_ID(), $cpt_taxes[0] );
				if ( is_array( $cpt_terms ) ) {
					$output = false;
					foreach( $cpt_terms as $cpt_term ) {
						if ( ! $output ) {
							$breadcrumb .= '<li class="breadcrumb-item"><a href="' . get_term_link( $cpt_term->name, $cpt_taxes[0] ) . '">' . $cpt_term->name . '</a></li>';
							$output = true;
						}
					}
				}
			}
		}
		// Cpt title
		$breadcrumb .= '<li class="breadcrumb-item">' . get_the_title() . '</li>';
	}
    // Close list
    $breadcrumb .= '</ol>';
    // Ouput
    return $breadcrumb;
}

/**
 * Create JSON-only breadcrumbs which is added to footer. Good for SEO.
 *
 * @since  1.0
 */
function test_json_html() {
	$json = array();
	$json = array(
		'retval' => array( 'testval', 'testval2' )
	);
	?><script>
		(function( $ ) {
			'use strict';
			$(function() {
				var bs4Breadcrumbs = <?php echo json_encode( $json ); ?>
			});
		})( jQuery );
	</script><?php
}
add_action( 'wp_head', 'test_json_html' );
