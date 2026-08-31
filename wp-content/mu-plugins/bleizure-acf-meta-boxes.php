<?php
// Native meta boxes replacing ACF's field-group admin UI. Reads/writes the
// exact same postmeta keys as bleizure-acf-shim.php resolves, driven by the
// same manifest (bleizure-acf-field-manifest.php) so there is one source of
// truth for field shape.
//
// One meta box per top-level manifest field (not one giant box per page),
// so the edit screen gets native collapsible/draggable boxes instead of a
// single wall of 30+ inputs.

add_action( 'add_meta_boxes', 'bleizure_register_meta_boxes' );
function bleizure_register_meta_boxes() {
	$post = get_post();
	if ( ! $post ) {
		return;
	}
	$context = bleizure_resolve_context( $post->ID );
	$manifest = bleizure_field_manifest();

	if ( ! isset( $manifest[ $context ] ) ) {
		return;
	}

	foreach ( $manifest[ $context ]['fields'] as $key => $spec ) {
		add_meta_box(
			'bleizure_' . $key,
			$spec['label'],
			'bleizure_render_meta_box',
			$post->post_type,
			'normal',
			'default',
			array( 'key' => $key, 'spec' => $spec )
		);
	}
}

function bleizure_render_meta_box( $post, $box ) {
	wp_nonce_field( 'bleizure_save_meta_' . $box['args']['key'], 'bleizure_meta_nonce_' . $box['args']['key'] );
	$key  = $box['args']['key'];
	$spec = $box['args']['spec'];
	if ( isset( $spec['fields'] ) ) {
		bleizure_render_group( $spec['fields'], $key, $post->ID );
	} else {
		bleizure_render_leaf( $spec, $key, $post->ID );
	}
}

function bleizure_render_group( array $fields, string $prefix, int $post_id ) {
	foreach ( $fields as $name => $sub ) {
		$meta_key = $prefix . '_' . $name;
		if ( isset( $sub['fields'] ) ) {
			echo '<fieldset style="border:1px solid #ddd;padding:10px 14px;margin-bottom:14px;"><legend style="padding:0 6px;"><strong>' . esc_html( $sub['label'] ) . '</strong></legend>';
			bleizure_render_group( $sub['fields'], $meta_key, $post_id );
			echo '</fieldset>';
		} else {
			bleizure_render_leaf( $sub, $meta_key, $post_id );
		}
	}
}

function bleizure_render_leaf( array $spec, string $meta_key, int $post_id ) {
	$value = get_post_meta( $post_id, $meta_key, true );
	echo '<p><label for="' . esc_attr( $meta_key ) . '"><strong>' . esc_html( $spec['label'] ) . '</strong></label><br>';

	switch ( $spec['type'] ) {
		case 'text':
			printf(
				'<input type="text" class="widefat" id="%1$s" name="bleizure_meta[%1$s]" value="%2$s" />',
				esc_attr( $meta_key ),
				esc_attr( $value )
			);
			break;

		case 'wysiwyg':
			wp_editor( $value, 'bleizure_editor_' . $meta_key, array(
				'textarea_name' => "bleizure_meta[{$meta_key}]",
				'textarea_rows' => 8,
				'media_buttons' => true,
			) );
			break;

		case 'image':
		case 'image_array': // storage is identical (attachment ID); only the shim's read-side return shape differs
			$id = (int) $value;
			printf(
				'<div class="bleizure-image-field" data-target="%1$s">
					<div class="bleizure-preview" style="margin-bottom:6px;">%2$s</div>
					<input type="hidden" id="%1$s" name="bleizure_meta[%1$s]" value="%3$s" />
					<button type="button" class="button bleizure-select-image">Select Image</button>
					<button type="button" class="button bleizure-remove-image"%4$s>Remove</button>
				</div>',
				esc_attr( $meta_key ),
				$id ? wp_get_attachment_image( $id, array( 120, 120 ) ) : '',
				esc_attr( $id ),
				$id ? '' : ' style="display:none;"'
			);
			break;
	}
	echo '</p>';
}

add_action( 'admin_enqueue_scripts', 'bleizure_meta_box_assets' );
function bleizure_meta_box_assets( $hook ) {
	if ( $hook !== 'post.php' && $hook !== 'post-new.php' ) {
		return;
	}
	wp_enqueue_media();
	wp_enqueue_script(
		'bleizure-meta-boxes',
		content_url( 'mu-plugins/assets/bleizure-meta-boxes.js' ),
		array( 'jquery' ),
		'1.0',
		true
	);
}

function bleizure_flatten_manifest_types( $context ) {
	$manifest = bleizure_field_manifest();
	$out = array();
	if ( ! isset( $manifest[ $context ]['fields'] ) ) {
		return $out;
	}
	bleizure_flatten_walk( $manifest[ $context ]['fields'], '', $out );
	return $out;
}

function bleizure_flatten_walk( array $fields, string $prefix, array &$out ) {
	foreach ( $fields as $name => $spec ) {
		$meta_key = $prefix === '' ? $name : $prefix . '_' . $name;
		if ( isset( $spec['fields'] ) ) {
			bleizure_flatten_walk( $spec['fields'], $meta_key, $out );
		} else {
			$out[ $meta_key ] = $spec['type'];
		}
	}
}

add_action( 'save_post', 'bleizure_save_meta_boxes' );
function bleizure_save_meta_boxes( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	if ( empty( $_POST['bleizure_meta'] ) || ! is_array( $_POST['bleizure_meta'] ) ) {
		return;
	}

	$context = bleizure_resolve_context( $post_id );

	// Verify at least one of this context's per-box nonces is present and valid
	// (each meta box carries its own nonce, named after its top-level key).
	$manifest = bleizure_field_manifest();
	if ( ! isset( $manifest[ $context ] ) ) {
		return;
	}
	$nonce_ok = false;
	foreach ( array_keys( $manifest[ $context ]['fields'] ) as $key ) {
		$nonce_field = 'bleizure_meta_nonce_' . $key;
		if ( isset( $_POST[ $nonce_field ] ) && wp_verify_nonce( $_POST[ $nonce_field ], 'bleizure_save_meta_' . $key ) ) {
			$nonce_ok = true;
			break;
		}
	}
	if ( ! $nonce_ok ) {
		return;
	}

	$type_lookup = bleizure_flatten_manifest_types( $context );

	foreach ( wp_unslash( $_POST['bleizure_meta'] ) as $meta_key => $raw ) {
		if ( ! isset( $type_lookup[ $meta_key ] ) ) {
			continue; // whitelist against manifest; never trust arbitrary POST keys
		}
		switch ( $type_lookup[ $meta_key ] ) {
			case 'wysiwyg':
				$value = wp_kses_post( $raw );
				break;
			case 'image':
			case 'image_array':
				$value = absint( $raw );
				break;
			default:
				$value = sanitize_text_field( $raw );
		}
		update_post_meta( $post_id, $meta_key, $value );
	}
}
