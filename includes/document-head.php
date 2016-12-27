<?php
/**
 * Document Head
 */

/* Meta
==============================================================================*/

/**
 * Remove WordPress generator/version.
 */
function uncode_sidekick_remove_wp_generator() {

	return '';

}
add_filter( 'the_generator', 'uncode_sidekick_remove_wp_generator' );


/* Styles
==============================================================================*/

/**
 * Enqueue frontend styles.
 */
function uncode_sidekick_child_theme_enqueue_styles() {

	$production_mode   = ot_get_option( '_uncode_production' );
	$resources_version = ( $production_mode === 'on' ) ? CHILD_THEME_VERSION : rand();
	$parent_style      = 'uncode-style';
	$deps              = array( 'uncode-custom-style' );

	// Parent stylesheet
	wp_enqueue_style( $parent_style, get_template_directory_uri() . '/library/css/style.css', array(), $resources_version );

	// Custom fonts stylesheet
	wp_enqueue_style( CHILD_THEME_PREFIX . '-fonts', '/css/fonts.css', $deps, $resources_version );

	// Child theme stylesheet
	wp_enqueue_style( CHILD_THEME_PREFIX, '/css/style.css', $deps, $resources_version );

}
add_action( 'wp_enqueue_scripts', 'uncode_sidekick_child_theme_enqueue_styles' );

/**
 * Enqueue login page styles.
 */
function uncode_sidekick_login_enqueue_styles() {

	$production_mode   = ot_get_option( '_uncode_production' );
	$resources_version = ( $production_mode === 'on' ) ? CHILD_THEME_VERSION : rand();
	$deps              = array();

	wp_enqueue_style( CHILD_THEME_PREFIX . '-login', '/css/login.css', array(), $resources_version );

}
add_action( 'login_enqueue_scripts', 'uncode_sidekick_login_enqueue_styles' );