<?php
/**
 * Bootstrap 4: Customizer
 *
 * @package WordPress
 * @subpackage Bootstrap_4
 * @since 1.0
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function bs4_customize_register( $wp_customize ) {

	global $bs4_defaults, $bs4_customizer_choices;

	$wp_customize->get_setting( 'blogname' )->transport          = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport   = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport  = 'postMessage';

	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector'            => '.site-title a',
		'render_callback'     => 'bs4_customize_partial_blogname',
	) );

	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector'            => '.site-description',
		'render_callback'     => 'bs4_customize_partial_blogdescription',
	) );

	/**
	 * Theme options.
	 */
	$wp_customize->add_section( 'theme_options', array(
		'title'               => __( 'Theme Options', 'bs4' ),
		'priority'            => 130, // Before Additional CSS.
	) );

	/**
	 * Appearance
	 *
	 * @since 0.1.0
	 */
	$wp_customize->add_section( 'edit_appearance', [
		'title'               => __( 'Appearance', 'bs4' ),
		'priority'            => '10'
	] );

	// Loop Style
	$wp_customize->add_setting( 'loop_post', [
		'default'             => $bs4_defaults['loop_post'],
		'sanitize_callback'   => 'esc_attr'
	] );

	$wp_customize->add_control( 'loop_post', [
		'label'               => __( 'Loop Type', 'bs4' ),
		'section'             => 'edit_appearance',
		'type'                => 'radio',
		'description'         => __( 'When the two column layout is assigned, the page title is in one column and content is in the other.', 'bs4' ),
		'choices' 			  => $bs4_customizer_choices['loop_types']
	] );

	// Shop Loop Style
	if ( class_exists( 'WooCommerce' ) ) {

		$wp_customize->add_setting( 'loop_product', [
			'default'             => $bs4_defaults['loop_product'],
			'sanitize_callback'   => 'esc_attr'
		] );

		$wp_customize->add_control( 'loop_product', [
			'label'               => __( 'Shop Loop Type', 'bs4' ),
			'section'             => 'edit_appearance',
			'type'                => 'radio',
			'description'         => __( 'Loop type for WooCommerce loops.', 'bs4' ),
			'choices' 			  => $bs4_customizer_choices['loop_types']
		] );

	}

	// Layouts
	$wp_customize->add_setting( 'layout', [
		'default'             => $bs4_defaults['layout'],
		'sanitize_callback'   => 'esc_attr'
	] );

	$wp_customize->add_control( 'layout', [
		'label'	 			  => __( 'Layout', 'bs4' ),
		'section' 			  => 'edit_appearance',
		'type' 				  => 'radio',
		'choices' 			  => $bs4_customizer_choices['layout']
	] );

	// Templates
	$wp_customize->add_setting( 'template', [
		'default' 			  => $bs4_defaults['template'],
		'sanitize_callback'   => 'esc_attr'
	] );

	$wp_customize->add_control( new WP_Customize_Select2( $wp_customize, 'template', [
		'label' 			  => __( 'Templates', 'bs4' ),
		'section' 			  => 'edit_appearance',
		'type' 				  => 'select2',
		'choices' 			  => $bs4_customizer_choices['templates']
	] ) );

	// Footer Widget Column
	$wp_customize->add_setting( 'col_footer_widget', [
		'default'             => $bs4_defaults['col_footer_widget'],
		'sanitize_callback'   => 'bs4_sanitize_select2_multi'
	] );

	$wp_customize->add_control( new WP_Customize_Select2( $wp_customize, 'col_footer_widget', [
		'label'   			  => 'Footer Widget Column',
		'section' 			  => 'edit_appearance',
		'type'    			  => 'select2',
		'choices' 			  => $bs4_customizer_choices['col_classes'],
		'multiple'			  => true // custom argument for multi-select
	] ) );

	/**
	 * Header Nav (child of 'Menus')
	 */
	$wp_customize->add_section( 'top_nav', [
		'title'               => __( 'Header Nav Options', 'bs4' ),
		'panel'               => 'nav_menus'
	] );

	// Header Nav Search
	$wp_customize->add_setting( 'top_nav_search', [
		'default'             => $bs4_defaults['top_nav_search'],
		'sanitize_callback'   => 'bs4_wp_sanitize_checkbox'
	] );

	$wp_customize->add_control( new WP_Customize_Select2( $wp_customize, 'top_nav_search', [
		'label' 			  => __( 'Navbar Search', 'bs4' ),
		'section' 			  => 'top_nav',
		'type' 				  => 'select2',
		'choices' 			  => $bs4_customizer_choices['navbar_search'],
		'multiple'			  => true // custom argument for multi-select
	] ) );

	// Header Nav Width
	$wp_customize->add_setting( 'container_top_nav', [
		'default'             => $bs4_defaults['container_top_nav'],
		'sanitize_callback'   => 'bs4_sanitize_select2_multi'
	] );

	$wp_customize->add_control( new WP_Customize_Select2( $wp_customize, 'container_top_nav', [
		'label'   			  => 'Nav Width',
		'section' 			  => 'top_nav',
		'type'    			  => 'select2',
		'choices' 			  => $bs4_customizer_choices['navbar_container'],
		'multiple'			  => true // custom argument for multi-select
	] ) );

	// Header Nav Color
	$wp_customize->add_setting( 'top_nav_placement', array(
		'default' 			  => $bs4_defaults['top_nav_placement'],
		'sanitize_callback'   => 'bs4_sanitize_select2_multi'
	) );

	$wp_customize->add_control( new WP_Customize_Select2( $wp_customize, 'top_nav_placement', array(
		'label' 			  => __( 'Navbar Placement', 'bs4' ),
		'section' 			  => 'top_nav',
		'type' 				  => 'select2',
		'choices' 			  => $bs4_customizer_choices['navbar_placement'],
		'multiple'			  => true // custom argument for multi-select
	) ) );

	// Header Nav Color
	$wp_customize->add_setting( 'top_nav_color', array(
		'default' 			  => $bs4_defaults['top_nav_color'],
		'sanitize_callback'   => 'bs4_sanitize_select2_multi'
	) );

	$wp_customize->add_control( new WP_Customize_Select2( $wp_customize, 'top_nav_color', array(
		'label' 			  => __( 'Navbar Color Schemes', 'bs4' ),
		'section' 			  => 'top_nav',
		'type' 				  => 'select2',
		'choices' 			  => $bs4_customizer_choices['navbar_colors'],
		'multiple'			  => true // custom argument for multi-select
	) ) );
}
add_action( 'customize_register', 'bs4_customize_register' );

/**
 * Render customized views from: $wp_customize->add_control()
 *
 * @since 0.1.0
 */
if ( class_exists( 'WP_Customize_Control' ) ) {

	// Templates render view
	class WP_Customize_Select2 extends WP_Customize_Control {

		public $type = 'select2';
		public $multiple; // Custom attribute to check if multi-select.

		public function bs4_multi_selected( $value, $selected ) {
			if ( ! in_array( $selected, $value ) ) return;
			return selected( 1, 1, false );
		}

		public function bs4_select2_options( $choices ) {
			$has_keys = ( bs4_is_associative_array( $this->choices ) == true ? true : false );
			$output = '';

			foreach ( $choices as $value => $label ) {

				$_val = ( $has_keys == true ? $value : $label );
				$selected = ( $this->multiple == true ? $this->bs4_multi_selected( $this->value(), $_val ) : selected( $this->value(), $_val, false ) );
				$output .= '<option value="' . esc_attr( $_val ) . '" ' . $selected . '>' . esc_html( $label ) . '</option>';

			}

			echo $output;
		}

		public function render_content() {
			if ( empty( $this->choices ) ) return;
			$multiple = ( $this->multiple == true ? 'multiple="multiple"' : '' );
			echo '<label>';
				echo '<span class="customize-control-title">' . esc_html( $this->label ) . '</span>';
				echo '<select class="select2" ' . $multiple . ' ' . $this->get_link() . '>';
					$this->bs4_select2_options( $this->choices );
				echo '</select>';
			echo '</label>';
		}
	}

}

/**
 * Custom sanitization functions for Customizer controls. Mandatory for security.
 *
 * @since 0.1.0
 */
// Sanitize checkbox
function bs4_wp_sanitize_checkbox( $checked ) {
	// Boolean check
	return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

/**
 * Sanitize the page layout options.
 */
function bs4_sanitize_page_layout( $input ) {
	$valid = array(
		'one-column' => __( 'One Column', 'bs4' ),
		'two-column' => __( 'Two Column', 'bs4' ),
	);

	if ( array_key_exists( $input, $valid ) ) return $input;

	return '';
}

/**
 * Sanitize the colorscheme.
 */
function bs4_sanitize_colorscheme( $input ) {
	$valid = array( 'light', 'dark', 'custom' );

	if ( in_array( $input, $valid ) ) {
		return $input;
	}

	return 'light';
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @since Bootstrap 4 1.0
 * @see bs4_customize_register()
 *
 * @return void
 */
function bs4_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since Bootstrap 4 1.0
 * @see bs4_customize_register()
 *
 * @return void
 */
function bs4_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Return whether we're previewing the front page and it's a static page.
 */
function bs4_is_static_front_page() {
	return ( is_front_page() && ! is_home() );
}

/**
 * Sanitize multi-select customizer field.
 */
function bs4_sanitize_select2( $values ) {
	$multi_values = ! is_array( $values ) ? explode( ',', $values ) : $values;
    return !empty( $multi_values ) ? array_map( 'sanitize_text_field', $multi_values ) : array();
}

/**
 * Sanitize multi-select customizer field.
 */
function bs4_sanitize_select2_multi( $values ) {
	$multi_values = ! is_array( $values ) ? explode( ',', $values ) : $values;
    return !empty( $multi_values ) ? array_map( 'sanitize_text_field', $multi_values ) : array();
}

/**
 * Return whether we're on a view that supports a one or two column layout.
 */
function bs4_is_view_with_layout_option() {
	// This option is available on all pages. It's also available on archives when there isn't a sidebar.
	return ( is_page() || ( is_archive() && ! is_active_sidebar( 'secondary' ) ) );
}

/**
 * Register css for customizer panel
 */
function bs4_customizer_register_styles() {
	wp_enqueue_style( 'bs4_select2', get_theme_file_uri( '/assets/css/select2.min.css' ) );
	wp_enqueue_style( 'bs4_customizer', get_theme_file_uri( '/assets/css/customizer.css' ) );
}
add_action( 'customize_controls_print_styles', 'bs4_customizer_register_styles' );

/**
 * Load dynamic logic for the customizer controls area.
 */
function bs4_panels_js() {
	wp_enqueue_script( 'bs4-customize-select2', get_theme_file_uri( '/assets/js/select2.full.min.js' ), array(), false, true );
	wp_enqueue_script( 'bs4-customize-select2-view', get_theme_file_uri( '/assets/js/customize-select2.js' ), array(), false, true );
}
add_action( 'customize_controls_enqueue_scripts', 'bs4_panels_js' );
