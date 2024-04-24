<?php
/**
 * This file adds functions to the Sycamore WordPress theme.
 *
 * @package Sycamore
 * @author  WP Engine
 * @license GNU General Public License v3
 * @link    https://sycamorewp.com/
 */

if ( ! function_exists( 'sycamore_setup' ) ) {

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * @since 0.8.0
	 *
	 * @return void
	 */
	function sycamore_setup() {

		// Make theme available for translation.
		load_theme_textdomain( 'sycamore', get_template_directory() . '/languages' );

		// Enqueue editor stylesheet.
		add_editor_style( get_template_directory_uri() . '/style.css' );

		// Remove core block patterns.
		remove_theme_support( 'core-block-patterns' );

	}
}
add_action( 'after_setup_theme', 'sycamore_setup' );

// Enqueue stylesheet.
add_action( 'wp_enqueue_scripts', 'sycamore_enqueue_stylesheet' );
function sycamore_enqueue_stylesheet() {

	wp_enqueue_style( 'sycamore', get_template_directory_uri() . '/style.css', array(), wp_get_theme()->get( 'Version' ) );

}

/**
 * Register block styles.
 *
 * @since 0.9.2
 */
function sycamore_register_block_styles() {

	$block_styles = array(
		'core/columns' => array(
			'columns-reverse' => __( 'Reverse', 'sycamore' ),
		),
		'core/group' => array(
			'shadow-light' => __( 'Shadow', 'sycamore' ),
			'shadow-solid' => __( 'Solid', 'sycamore' ),
		),
		'core/list' => array(
			'no-disc' => __( 'No Disc', 'sycamore' ),
		),
		'core/quote' => array(
			'shadow-light' => __( 'Shadow', 'sycamore' ),
			'shadow-solid' => __( 'Solid', 'sycamore' ),
		),
		'core/social-links' => array(
			'outline' => __( 'Outline', 'sycamore' ),
		),
	);

	foreach ( $block_styles as $block => $styles ) {
		foreach ( $styles as $style_name => $style_label ) {
			register_block_style(
				$block,
				array(
					'name'  => $style_name,
					'label' => $style_label,
				)
			);
		}
	}
}
add_action( 'init', 'sycamore_register_block_styles' );

/**
 * Register block pattern categories.
 *
 * @since 1.0.4
 */
function sycamore_register_block_pattern_categories() {

	register_block_pattern_category(
		'sycamore-page',
		array(
			'label'       => __( 'Page', 'sycamore' ),
			'description' => __( 'Create a full page with multiple patterns that are grouped together.', 'sycamore' ),
		)
	);
	register_block_pattern_category(
		'sycamore-pricing',
		array(
			'label'       => __( 'Pricing', 'sycamore' ),
			'description' => __( 'Compare features for your digital products or service plans.', 'sycamore' ),
		)
	);

}

add_action( 'init', 'sycamore_register_block_pattern_categories' );
