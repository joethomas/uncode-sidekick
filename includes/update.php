<?php
/**
 * Disable Child Theme Update
 */

function uncode_sidekick_do_not_update_theme_22362527( $r, $url ) {

	if ( 0 !== strpos( $url, 'http://api.wordpress.org/themes/update-check' ) ) {

		return $r; // Not a theme update request. Bail immediately.

	}

	$themes = unserialize( $r['body']['themes'] );

	unset( $themes[ get_option( 'template' ) ] );
	unset( $themes[ get_option( 'stylesheet' ) ] );

	$r['body']['themes'] = serialize( $themes );

	return $r;

}
add_filter( 'http_request_args', 'uncode_sidekick_do_not_update_theme_22362527', 5, 2 );