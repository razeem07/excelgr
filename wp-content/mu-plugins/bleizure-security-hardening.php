<?php
/**
 * Basic security hardening: hide the WordPress version string and
 * disable XML-RPC, since this site doesn't use remote publishing or
 * the Jetpack/mobile-app APIs that depend on it.
 */

// Remove the "WordPress X.Y.Z" generator meta tag from <head>, RSS feeds, and admin footer.
remove_action( 'wp_head', 'wp_generator' );
add_filter( 'the_generator', '__return_empty_string' );

// Disable XML-RPC entirely (closes the pingback brute-force/DDoS amplification vector).
add_filter( 'xmlrpc_enabled', '__return_false' );

// Stop WordPress advertising XML-RPC support in <head> and HTTP headers.
remove_action( 'wp_head', 'rsd_link' );
add_filter( 'wp_headers', function ( $headers ) {
	unset( $headers['X-Pingback'] );
	return $headers;
} );
