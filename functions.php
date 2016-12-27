<?php
/**
 * Uncode Sidekick Theme Functions
 */


/* Global Variables & Constants
==============================================================================*/

/**
 * Define the constants for use within the child theme
 */

// Child theme
$theme = wp_get_theme();

define( 'CHILD_THEME_PREFIX', get_stylesheet() ); // The name of the child theme folder in wp-content/themes
define( 'CHILD_THEME_NAME', $theme->get( 'Name' ) );
define( 'CHILD_THEME_URL', $theme->get( 'ThemeURI' ) );
define( 'CHILD_THEME_VERSION', $theme->get( 'Version' ) );
define( 'CHILD_THEME_DOMAIN', $theme->get( 'TextDomain' ) );
define( 'CHILD_THEME_AUTHOR', $theme->get( 'Author' ) );
define( 'CHILD_THEME_AUTHOR_URI', $theme->get( 'Author URI' ) );


/* Bootstrap
==============================================================================*/

require_once( '/includes/document-head.php' ); // controls styles, scripts, and meta tags
require_once( '/includes/shortcodes.php' ); // controls child theme shortcodes
require_once( '/includes/update.php' ); // controls theme updates
