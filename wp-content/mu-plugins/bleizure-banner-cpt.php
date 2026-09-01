<?php
// "Banner" custom post type — replaces the old fixed 3-banner setup on the
// homepage (home_banner / home_banner_2 / home_banner_3 fields on the Home
// page) with an unlimited, orderable list of banners managed as posts.
//
// post_title is an admin-only label for telling banners apart in the list
// (the actual displayed heading is the "headline" meta field below, which
// allows inline HTML like <br> the way the old ACF fields did). Ordering is
// via WP's native "page-attributes" Order field; the homepage queries by
// menu_order ascending.

function bleizure_register_banner_cpt() {
	register_post_type( 'banner', array(
		'labels' => array(
			'name'               => 'Banners',
			'singular_name'      => 'Banner',
			'menu_name'          => 'Banners',
			'all_items'          => 'All Banners',
			'edit_item'          => 'Edit Banner',
			'view_item'          => 'View Banner',
			'add_new_item'       => 'Add New Banner',
			'add_new'            => 'Add New Banner',
			'new_item'           => 'New Banner',
			'search_items'       => 'Search Banners',
			'not_found'          => 'No banners found',
			'not_found_in_trash' => 'No banners found in Trash',
		),
		'public'            => true,
		'hierarchical'      => false,
		'show_ui'           => true,
		'show_in_menu'      => true,
		'show_in_admin_bar' => true,
		'show_in_nav_menus' => false,
		'show_in_rest'      => true,
		'menu_icon'         => 'dashicons-images-alt2',
		'supports'          => array( 'title', 'thumbnail', 'page-attributes' ),
		'has_archive'       => false,
		'rewrite'           => false,
		'query_var'         => false,
	) );
}
add_action( 'init', 'bleizure_register_banner_cpt' );
