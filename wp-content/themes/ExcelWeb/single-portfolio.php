<?php
// No detail page for individual portfolio items - the listing/lightbox on the
// Portfolio page (and the Latest Work section on the homepage) is the only
// place projects are viewed. Send any direct hit on a single portfolio URL
// back to the Portfolio archive page instead of rendering a dead template.
$portfolio_page = get_posts( array(
	'post_type'      => 'page',
	'posts_per_page' => 1,
	'meta_key'       => '_wp_page_template',
	'meta_value'     => 'portfoliopage.php',
	'fields'         => 'ids',
) );

$redirect_url = ! empty( $portfolio_page ) ? get_permalink( $portfolio_page[0] ) : home_url( '/' );

wp_redirect( $redirect_url, 301 );
exit;
