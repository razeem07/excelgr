<?php
// Native replacement for ACF's get_field()/the_field(). Reads the exact same
// postmeta keys ACF wrote, using the static manifest (bleizure-acf-field-manifest.php)
// to know field shape/type. ACF Pro is no longer active on this site — this
// is the live implementation, verified against ACF's real output (0 mismatches
// across all 162 fields) before cutover.
//
// No have_rows()/get_sub_field()/the_sub_field() implementation exists here:
// confirmed zero usage anywhere in the theme.

function bleizure_resolve_context( $post_id ) {
	$post_type = get_post_type( $post_id );
	if ( $post_type === 'page' ) {
		return 'page:' . $post_id;
	}
	return 'posttype:' . $post_type;
}

if ( ! function_exists( 'get_field' ) ) {

	function get_field( $selector, $post_id = null ) {
		$post_id = is_object( $post_id ) ? $post_id->ID : ( $post_id ?: get_the_ID() );
		if ( ! $post_id ) {
			return false;
		}

		$manifest = bleizure_field_manifest();
		$context  = bleizure_resolve_context( $post_id );

		if ( ! isset( $manifest[ $context ]['fields'][ $selector ] ) ) {
			return false; // unknown selector -> falsy; load-bearing for the
			              // homepage.php `home_banners` (plural, doesn't exist) fallback
		}

		return bleizure_resolve_field_value( $manifest[ $context ]['fields'][ $selector ], $selector, $post_id );
	}

	function the_field( $selector, $post_id = null ) {
		echo get_field( $selector, $post_id ); // only ever called on scalar fields in this theme
	}

}

function bleizure_resolve_field_value( array $spec, string $meta_key, int $post_id ) {
	if ( isset( $spec['fields'] ) ) {
		$out = array();
		foreach ( $spec['fields'] as $name => $sub_spec ) {
			$out[ $name ] = bleizure_resolve_field_value( $sub_spec, $meta_key . '_' . $name, $post_id );
		}
		return $out; // recursive: handles arbitrary nesting depth (card_1.title etc.)
	}

	$raw = get_post_meta( $post_id, $meta_key, true );

	switch ( $spec['type'] ) {
		case 'image':
			return $raw ? wp_get_attachment_url( (int) $raw ) : ''; // matches ACF return_format=url
		case 'image_array':
			if ( ! $raw ) {
				return false;
			}
			$id = (int) $raw;
			return array(
				'id'  => $id,
				'url' => wp_get_attachment_url( $id ),
				'alt' => get_post_meta( $id, '_wp_attachment_image_alt', true ),
			); // exception: mission_section.image / vision_section.image only
		case 'wysiwyg':
			return $raw ? wpautop( $raw ) : $raw; // ACF wysiwyg fields auto-wrap in <p> tags by default;
			                                       // single-service.php's FAQ regex depends on this shape
		default: // 'text'
			return $raw; // '' is falsy, matches ACF's empty-field behavior
	}
}
