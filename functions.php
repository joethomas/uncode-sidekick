<?php
/*
	Uncode Sidekick Functions
*/


/* Global Variables & Constants
==============================================================================*/

// Child theme
$theme = wp_get_theme( get_stylesheet() );

// Define constants.
if ( ! defined( 'CHILD_THEME_SLUG' ) ) {
	define( 'CHILD_THEME_SLUG', get_stylesheet() );
}
if ( ! defined( 'CHILD_THEME_PREFIX' ) ) {
	define( 'CHILD_THEME_PREFIX', 'usk' );
}
if ( ! defined( 'CHILD_THEME_NAME' ) ) {
	define( 'CHILD_THEME_NAME', $theme->get( 'Name' ) );
}
if ( ! defined( 'CHILD_THEME_URL' ) ) {
	define( 'CHILD_THEME_URL', $theme->get( 'ThemeURI' ) );
}
if ( ! defined( 'CHILD_THEME_VERSION' ) ) {
	define( 'CHILD_THEME_VERSION', $theme->get( 'Version' ) );
}
if ( ! defined( 'CHILD_THEME_DOMAIN' ) ) {
	define( 'CHILD_THEME_DOMAIN', $theme->get( 'TextDomain' ) );
}
if ( ! defined( 'CHILD_THEME_AUTHOR' ) ) {
	define( 'CHILD_THEME_AUTHOR', $theme->get( 'Author' ) );
}
if ( ! defined( 'CHILD_THEME_AUTHOR_URI' ) ) {
	define( 'CHILD_THEME_AUTHOR_URI', $theme->get( 'Author URI' ) );
}
if ( ! defined( 'CHILD_THEME_DIR' ) ) {
	define( 'CHILD_THEME_DIR', get_stylesheet_directory() );
}
if ( ! defined( 'CHILD_THEME_URI' ) ) {
	define( 'CHILD_THEME_URI', get_stylesheet_directory_uri() );
}


/* Styles & Scripts
==============================================================================*/

// Enqueue styles and scripts.
function usk_enqueue_styles() {
	$production_mode    = function_exists( 'ot_get_option' ) ? ot_get_option( '_uncode_production' ) : 'on';
	$resources_version  = ( $production_mode === 'on' ) ? CHILD_THEME_VERSION : rand();

	// Disable versioning if WP Rocket is removing query strings or minifying assets
	if ( function_exists( 'get_rocket_option' ) && ( get_rocket_option( 'remove_query_strings' ) || get_rocket_option( 'minify_css' ) || get_rocket_option( 'minify_js' ) ) ) {
		$resources_version = null;
	}

	wp_enqueue_style( 'uncode-style', get_template_directory_uri() . '/library/css/style.css', array(), $resources_version );
	wp_enqueue_style( 'child-style', CHILD_THEME_URI . '/style.css', array( 'uncode-style' ), $resources_version );
}
add_action( 'wp_enqueue_scripts', 'usk_enqueue_styles', 100 );