<?php
/**
 * Uncode Sidekick Functions
 */


/* Global Variables & Constants
==============================================================================*/

/**
 * Define the constants for use within the child theme.
 */

// Child theme
$theme = wp_get_theme( get_stylesheet() );

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


/* Bootstrap
==============================================================================*/


/* Styles & Scripts
==============================================================================*/

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


/* Per Page Custom Logo (Dark & Light) & Logo Height (Normal & Mobile)
==============================================================================*/

/**
 * Filter logo and logo height according to post ID.
 */
function usk_filter_display_logo( $val, $option_id ) {
	global $post;

	if ( ! $post instanceof WP_Post ) {
		return $val;
	}

	$post_id = $post->ID;

	// Read Uncode custom fields from post meta
	switch ( $option_id ) {
		case '_uncode_logo_light':
			$custom_val = get_post_meta( $post_id, 'joe_custom_logo_light', true );
			if ( $custom_val ) {
				$val = $custom_val;
			}
			break;

		case '_uncode_logo_dark':
			$custom_val = get_post_meta( $post_id, 'joe_custom_logo_dark', true );
			if ( $custom_val ) {
				$val = $custom_val;
			}
			break;

		case '_uncode_logo_height':
			$custom_val = get_post_meta( $post_id, 'joe_custom_logo_height', true );
			if ( $custom_val ) {
				$val = $custom_val;
			}
			break;

		case '_uncode_logo_height_mobile':
			$custom_val = get_post_meta( $post_id, 'joe_custom_logo_height_mobile', true );
			if ( $custom_val ) {
				$val = $custom_val;
			}
			break;
	}

	return $val;
}
add_filter( 'uncode_ot_get_option', 'usk_filter_display_logo', 10, 2 );

/**
 * Suffix logo heights with 'px'
 */
function usk_px_suffix_to_logo_heights( $value, $key, $post_id ) {
	// Target only your custom height fields
	if ( in_array( $key, array( 'joe_custom_logo_height', 'joe_custom_logo_height_mobile' ), true ) ) {
		// Avoid double-appending
		if ( is_numeric( $value ) ) {
			$value .= 'px';
		}
	}
	return $value;
}
add_filter( 'uncode_custom_field_value', 'usk_px_suffix_to_logo_heights', 10, 3 );
