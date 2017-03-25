<?php
/**
 * Make theme compatible with WooCommerce, bbPress, and BuddyPress if activated.
 *
 * @package     WordPress
 * @subpackage  Bootstrap_4
 * @since       1.0
 */

 /**
  * Breadcrumbs
  *
  * @since  1.0
  */

if ( class_exists( 'bbPress' ) ) add_action( 'bbp_before_main_content', 'bbp_breadcrumb', 20 );

if ( class_exists( 'WooCommerce' ) ) add_action( 'wc_before_main_content', 'woocommerce_breadcrumb', 20, 0 );

add_action( 'top_breadcrumbs', 'bs4_breadcrumbs' );

/**
 * Remove ACF Select2 library from Customizer to stop interference.
 *
 * @since  1.0
 */
function bs4_acf_fix_admin_scripts_styles() {
	wp_dequeue_script( 'select2' );
	wp_dequeue_style( 'select2' );
}
add_action( 'admin_enqueue_scripts', 'bs4_acf_fix_admin_scripts_styles' );

/**
 * If BuddyPress plugin is actived then proceed.
 */
if ( class_exists( 'BuddyPress' ) ) {

    /**
     * At BuddyPress loop open add title.
     *
     * @link   http://masonry.desandro.com/extras.html#bootstrap
     * @since  1.0
     */
    function open_buddypress_loop_title() {
    	$_get_title = get_the_title();
    	echo apply_filters( '', '<h1 class="entry-title">' . $_get_title . '</h1>' , $_get_title );
    }
    add_action( 'bp_before_directory_activity_content', 'open_buddypress_loop_title', 20 );

    /**
     * Change default size of BuddyPress avatar
     *
     * @return  array Breadcrumb with new args.
     * @link    https://codex.buddypress.org/themes/guides/customizing-buddypress-avatars/
     * @since   1.0
     */
    define ( 'BP_AVATAR_THUMB_WIDTH', 96 );
    define ( 'BP_AVATAR_THUMB_HEIGHT', 96 );
    define ( 'BP_AVATAR_FULL_WIDTH', 96 );
    define ( 'BP_AVATAR_FULL_HEIGHT', 96 );

    /**
     * Change default size of BuddyPress avatar
     *
     * @return  array Breadcrumb with new args.
     * @link    https://codex.buddypress.org/themes/guides/customizing-buddypress-avatars/
     * @since   1.0
     */
    function bs4_bp_addclass_to_btn( $args ) {
    	$args['link_class'] = $args['link_class'] . ' btn btn-secondary btn-sm';
    	return $args;
    }
    add_filter( 'bp_get_send_public_message_button', 'bs4_bp_addclass_to_btn' );
    add_filter( 'bp_get_blogs_visit_blog_button', 'bs4_bp_addclass_to_btn' );
    add_filter( 'bp_get_add_friend_button', 'bs4_bp_addclass_to_btn' );
    add_filter( 'bp_get_group_new_topic_button', 'bs4_bp_addclass_to_btn' );
    add_filter( 'bp_get_group_join_button', 'bs4_bp_addclass_to_btn' );
    add_filter( 'bp_get_group_create_button', 'bs4_bp_addclass_to_btn' );
    add_filter( 'bp_get_send_message_button_args', 'bs4_bp_addclass_to_btn' );

    /**
     * Changes the blog author links on a buddypress site to link to the author's buddypress member profile.
     */
    function bs4_wp_buddypress_fix_author_link( $link, $author_id, $author_nicename ) {

        if ( function_exists( 'bp_core_get_user_domain' ) ) {

            $user_link = trailingslashit( bp_core_get_user_domain( $author_id ) . 'author' );
            return $user_link;

        }

       return $link;
    }
    add_filter( 'author_link', 'bs4_wp_buddypress_fix_author_link', 10, 3 );

    function boone_remove_blogs_nav() {
        bp_core_remove_nav_item( 'notifications' );
    }
    add_action( 'bp_setup_nav', 'boone_remove_blogs_nav', 15 );


    /**
     * Render the navigation markup for the displayed user.
     *
     * @since 1.1.0
     */
    function bs4_bp_get_displayed_user_nav() {
    	$bp = buddypress();
    	foreach ( $bp->members->nav->get_primary() as $user_nav_item ) {
    		if ( empty( $user_nav_item->show_for_displayed_user ) && ! bp_is_my_profile() ) {
    			continue;
    		}
    		$selected = '';
    		if ( bp_is_current_component( $user_nav_item->slug ) ) {
    			$selected = ' active';
    		}
    		if ( bp_loggedin_user_domain() ) {
    			$link = str_replace( bp_loggedin_user_domain(), bp_displayed_user_domain(), $user_nav_item->link );
    		} else {
    			$link = trailingslashit( bp_displayed_user_domain() . $user_nav_item->link );
    		}
    		/**
    		 * Filters the navigation markup for the displayed user.
    		 *
    		 * This is a dynamic filter that is dependent on the navigation tab component being rendered.
    		 *
    		 * @since 1.1.0
    		 *
    		 * @param string $value         Markup for the tab list item including link.
    		 * @param array  $user_nav_item Array holding parts used to construct tab list item.
    		 *                              Passed by reference.
    		 */
    		echo apply_filters_ref_array( 'bp_get_displayed_user_nav_' . $user_nav_item->css_id, array( '<li id="' . $user_nav_item->css_id . '-personal-li" class="nav-item"><a id="user-' . $user_nav_item->css_id . '" href="' . $link . '" class="nav-link' . $selected . '">' . $user_nav_item->name . '</a></li>', &$user_nav_item ) );
    	}
    }

    /**
     * Output the "options nav", the secondary-level single item navigation menu.
     *
     * Uses the component's nav global to render out the sub navigation for the
     * current component. Each component adds to its sub navigation array within
     * its own setup_nav() function.
     *
     * This sub navigation array is the secondary level navigation, so for profile
     * it contains:
     *      [Public, Edit Profile, Change Avatar]
     *
     * The function will also analyze the current action for the current component
     * to determine whether or not to highlight a particular sub nav item.
     *
     * @since 1.0.0
     *
     *       viewed user.
     *
     * @param string $parent_slug Options nav slug.
     * @return string
     */
    function bs4_bp_get_options_nav( $parent_slug = '' ) {
    	$bp = buddypress();
    	// If we are looking at a member profile, then the we can use the current
    	// component as an index. Otherwise we need to use the component's root_slug.
    	$component_index = !empty( $bp->displayed_user ) ? bp_current_component() : bp_get_root_slug( bp_current_component() );
    	$selected_item   = bp_current_action();
    	// Default to the Members nav.
    	if ( ! bp_is_single_item() ) {
    		// Set the parent slug, if not provided.
    		if ( empty( $parent_slug ) ) {
    			$parent_slug = $component_index;
    		}
    		$secondary_nav_items = $bp->members->nav->get_secondary( array( 'parent_slug' => $parent_slug ) );
    		if ( ! $secondary_nav_items ) {
    			return false;
    		}
    	// For a single item, try to use the component's nav.
    	} else {
    		$current_item = bp_current_item();
    		$single_item_component = bp_current_component();
    		// Adjust the selected nav item for the current single item if needed.
    		if ( ! empty( $parent_slug ) ) {
    			$current_item  = $parent_slug;
    			$selected_item = bp_action_variable( 0 );
    		}
    		// If the nav is not defined by the parent component, look in the Members nav.
    		if ( ! isset( $bp->{$single_item_component}->nav ) ) {
    			$secondary_nav_items = $bp->members->nav->get_secondary( array( 'parent_slug' => $current_item ) );
    		} else {
    			$secondary_nav_items = $bp->{$single_item_component}->nav->get_secondary( array( 'parent_slug' => $current_item ) );
    		}
    		if ( ! $secondary_nav_items ) {
    			return false;
    		}
    	}
    	// Loop through each navigation item.
    	foreach ( $secondary_nav_items as $subnav_item ) {
    		if ( empty( $subnav_item->user_has_access ) ) {
    			continue;
    		}
    		// If the current action or an action variable matches the nav item id, then add a highlight CSS class.
    		if ( $subnav_item->slug === $selected_item ) {
    			$selected = ' active';
    		} else {
    			$selected = '';
    		}
    		// List type depends on our current component.
    		$list_type = bp_is_group() ? 'groups' : 'personal';
    		/**
    		 * Filters the "options nav", the secondary-level single item navigation menu.
    		 *
    		 * This is a dynamic filter that is dependent on the provided css_id value.
    		 *
    		 * @since 1.1.0
    		 *
    		 * @param string $value         HTML list item for the submenu item.
    		 * @param array  $subnav_item   Submenu array item being displayed.
    		 * @param string $selected_item Current action.
    		 */
            echo apply_filters( 'bs4_bp_get_options_nav_' . $subnav_item->css_id, '<a href="' . esc_url( $subnav_item->link ) . '" class="dropdown-item ' . esc_attr( $subnav_item->css_id ) . ' ' . $selected . '">' . $subnav_item->name . '</a>', $subnav_item, $selected_item );
    	}
    }

    // define the bp_field_css_classes callback
    function bs4_filter_bp_field_css_classes( $classes ) {
        $classes[] = 'row';

        return $classes;
    };
    add_filter( 'bp_field_css_classes', 'bs4_filter_bp_field_css_classes', 10, 1 );

    /**
     * Filters the value returned by bp_core_fetch_avatar.
     *
     * @since 1.1.3
     *
     * @param array $value HTML image element containing the activity avatar.
     */
    function bs4_bp_adjust_activity_avatar( $args ) {
        $args = bp_core_fetch_avatar([
            'width'   => '38',
            'height'  => '38'
        ]);
        return $args;
    }
    add_filter( 'bp_get_activity_avatar', 'bs4_bp_adjust_activity_avatar', 10, 1 );

}

/**
 * If bbPress plugin is activated then proceed.
 */
if (class_exists( 'bbPress' ) ) {
	/**
	 * Make bbPress breadcrumbs Bootstrap 4 friendly.
	 *
	 * @return array Breadcrumb with new args.
	 * @since  1.0
	 */
	function custom_bbp_breadcrumb() {
		$args = [
			'before'    => '<ol class="breadcrumb"><li class="breadcrumb-item">',
			'after'     => '</li></ol>',
			'sep' 		=> '</li><li class="breadcrumb-item">'
		];
	    return $args;
	}
	add_filter( 'bbp_before_get_breadcrumb_parse_args', 'custom_bbp_breadcrumb' );

	/**
	 * Remove bbPress text: "This forum contains %1$s and %2$s"
	 *
	 * @since  1.0
	 */
	add_filter( 'bbp_get_single_forum_description', '__return_false' );
	add_filter( 'bbp_get_single_topic_description', '__return_false' );
}

/**
 * If WooCommerce plugin is activated then proceed.
 */
if ( class_exists( 'WooCommerce' ) ) {
    /**
     * Remove default Woocommerce Stylesheet
     *
     * @return array Breadcrumb with new args.
     * @link   https://docs.woocommerce.com/document/disable-the-default-stylesheet/
     * @since  1.0
     */
    add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

    /**
     * This snippet removes the action that inserts thumbnails to products in the loop
     *
     * @since  1.0
     */
    if ( ! function_exists( 'woocommerce_template_loop_product_thumbnail' ) ) {

        function woocommerce_template_loop_product_thumbnail() {
            echo woocommerce_get_product_thumbnail();
        }

    }

    /**
     * Change default 'Add to Cart' text in WooCommerce archives.
     *
     * @return array Breadcrumb with new args.
     * @link   https://docs.woocommerce.com/document/change-add-to-cart-button-text/
     * @since  1.0
     */
    function woo_archive_custom_cart_button_text() {
        return '<i class="fa fa-cart-plus" aria-hidden="true"></i>';
    }
    add_filter( 'woocommerce_product_add_to_cart_text', 'woo_archive_custom_cart_button_text' );

    /**
     * WooCommerce shop/archive title.
     *
     * @link   http://masonry.desandro.com/extras.html#bootstrap
     * @since  1.0
     */
    function bs4_wc_shop_title() {
    	?><h1 class="page-title"><?php woocommerce_page_title(); ?></h1><?php
    }
    add_action( 'wc_before_main_content', 'bs4_wc_shop_title', 20 );

    if ( ! function_exists( 'woocommerce_get_product_thumbnail' ) ) {

    	function woocommerce_get_product_thumbnail( $size = 'shop_catalog', $placeholder_width = 0, $placeholder_height = 0  ) {
            global $post, $woocommerce;
            $output = '<div class="card-img-top">';

    	        if ( has_post_thumbnail() ) {

    				$output .= get_the_post_thumbnail( $post->ID, $size, array( 'class' => 'img-fluid' ) );

    			}

            $output .= '</div>';
            return $output;
        }

    }

    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

    /**
     * At WooCommerce loop open add wrapper and resizer column for jQuery Masonry.
     *
     * @link   http://masonry.desandro.com/extras.html#bootstrap
     * @since  1.0
     */
    function bs4_open_loop_product_row() {
        $html = '';

        if ( bs4_option( 'loop_product' ) == 'loop-tile' || bs4_option( 'loop_product' ) == 'loop-grid' )
            $html = '<div id="' . bs4_option( 'loop_product' ) . '"' . bs4_row_class( 'row_loop', 'row_loop', false ) . '>';
     	else
    		$html = '<div id="' . bs4_option( 'loop_product' ) . '">';

        echo $html;
    }
    add_action( 'open_loop_product', 'bs4_open_loop_product_row', 60 );

    function bs4_open_loop_product_masonry() {
        $html = '';
    	if ( bs4_option( 'loop_product' ) == 'loop-tile' ) $html = '<div class="tile-sizer ' . bs4_column_class( 'col_loop_product', 'tile-sizer', false ) . '"></div>';
        echo $html;
    }
    add_action( 'open_loop_product', 'bs4_open_loop_product_masonry', 70 );

    /**
     * Make WooCommerce breadcrumbs Bootstrap 4 friendly.
     *
     * @return array Breadcrumb with new args.
     * @link   https://docs.woocommerce.com/document/customise-the-woocommerce-breadcrumb/
     * @since  1.0
     */
    function bs4_filter_default_wc_breadcrumbs() {
    	$breadcrumbs = array(
            'delimiter'   => ' ',
            'wrap_before' => '<ol class="breadcrumb">',
            'wrap_after'  => '</ol>',
            'before'      => '<li class="breadcrumb-item">',
            'after'       => '</li>',
            'home'        => _x( 'Home', 'breadcrumb', 'bs4' )
        );
        return $breadcrumbs;
    }
    add_filter( 'woocommerce_breadcrumb_defaults', 'bs4_filter_default_wc_breadcrumbs' );

    /**
     * Open WooCommerce single product Bootstrap 'row' around image and summary.
     *
     * @since  1.0
     */
    function bs4_wc_open_single_product_row() {
    	?><div class="row"><?php
    }
    add_action( 'woocommerce_before_single_product_summary', 'bs4_wc_open_single_product_row', 9 );

    /**
     * Close WooCommerce single product Bootstrap 'row' around image and summary.
     *
     * @since  1.0
     */
    function bs4_wc_close_single_product_row() {
    	?></div><?php
    }
    add_action( 'woocommerce_after_single_product_summary', 'bs4_wc_close_single_product_row', 9 );

    /**
     * Remove WooCommerce Results Count on loop.
     *
     * @since  1.0
     */
    remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );

    /**
     * Remove WooCommerce Catalog select on loop.
     *
     * @since  1.0
     */
    remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

    /**
     * Remove WooCommerce 'Sales' display on loop.
     *
     * @since  1.0
     */
    remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
}
