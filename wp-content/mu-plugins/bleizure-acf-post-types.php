<?php
// Native replacement for ACF Pro's Post Types UI (acf-post-type records).
// Config copied from the live ACF settings (public, show_in_rest, supports,
// has_archive, rewrite) so front-end and admin behavior stay unchanged.
//
// NOTE: has_archive is FALSE for all 5, matching ACF's current config exactly.
// The "View all" archive links for portfolio/clients on the homepage are
// already dead today because of this — do not "fix" that as part of this file.
//
// clients/faq are NOT registered here — they already have their own native
// registration in bleizure-post-types.php, unrelated to ACF.

function bleizure_acf_cpt_labels( $singular, $plural ) {
	return array(
		'name'               => $plural,
		'singular_name'      => $singular,
		'menu_name'          => $plural,
		'all_items'          => "All {$plural}",
		'edit_item'          => "Edit {$singular}",
		'view_item'          => "View {$singular}",
		'add_new_item'       => "Add New {$singular}",
		'add_new'            => "Add New {$singular}",
		'new_item'           => "New {$singular}",
		'search_items'       => "Search {$plural}",
		'not_found'          => 'No ' . strtolower( $plural ) . ' found',
		'not_found_in_trash' => 'No ' . strtolower( $plural ) . ' found in Trash',
	);
}

function bleizure_register_acf_replacement_post_types() {
	$post_types = array(
		'portfolio'   => array( 'Portfolio', 'Portfolios' ),
		'service'     => array( 'Service', 'Services' ),
		'gallery'     => array( 'Gallery Item', 'Gallery' ),
		'testimonial' => array( 'Testimonial', 'Testimonials' ),
		// 'process' removed: "Our Process" is now a plain page with its own
		// custom fields (page ID 271), not a post type — see ourprocesspage.php.
	);

	foreach ( $post_types as $slug => $names ) {
		$supports = array( 'title', 'editor', 'thumbnail', 'custom-fields' );
		if ( $slug === 'service' ) {
			$supports[] = 'page-attributes'; // servicespage.php already orders by menu_order
		}
		register_post_type( $slug, array(
			'labels'            => bleizure_acf_cpt_labels( $names[0], $names[1] ),
			'public'            => true,
			'hierarchical'      => false,
			'show_ui'           => true,
			'show_in_menu'      => true,
			'show_in_admin_bar' => true,
			'show_in_nav_menus' => true,
			'show_in_rest'      => true,
			'menu_icon'         => 'dashicons-admin-post',
			'supports'          => $supports,
			'has_archive'       => false,
			'rewrite'           => array( 'slug' => $slug, 'with_front' => true, 'pages' => true, 'feeds' => false ),
			'query_var'         => true,
		) );
	}
}
add_action( 'init', 'bleizure_register_acf_replacement_post_types' );
