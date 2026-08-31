<?php

// Clean up unregistered CPTs and Taxonomies to clear permalinks & REST API routes
function unregister_old_cpts_and_taxonomies() {
    unregister_post_type('fleets');
    unregister_post_type('destinations');
    unregister_post_type('transport');
    unregister_post_type('attraction');
    unregister_taxonomy('destination_category');
}
add_action('init', 'unregister_old_cpts_and_taxonomies', 99);


// Register Clients CPT (Image only)
function register_clients_cpt() {
    register_post_type('clients', array(
        'labels' => array(
            'name'          => 'Clients',
            'singular_name' => 'Client',
            'add_new_item'  => 'Add New Client',
            'edit_item'     => 'Edit Client',
            'all_items'     => 'All Clients',
        ),
        'public'       => true,
        'show_in_rest' => true,
        'menu_icon'    => 'dashicons-images-alt2',
        'supports'     => array('title', 'thumbnail'),
    ));
}
add_action('init', 'register_clients_cpt');


// Register FAQ CPT
function register_cpt_faq() {
    $labels = array(
        'name'          => 'FAQs',
        'singular_name' => 'FAQ',
        'menu_name'     => 'FAQs',
        'add_new'       => 'Add New',
        'add_new_item'  => 'Add New FAQ',
        'edit_item'     => 'Edit FAQ',
        'new_item'      => 'New FAQ',
        'view_item'     => 'View FAQ',
        'search_items'  => 'Search FAQs',
        'not_found'     => 'No FAQs found',
    );

    $args = array(
        'labels'       => $labels,
        'public'       => true,
        'menu_icon'    => 'dashicons-editor-help',
        'supports'     => array('title', 'editor'),
        'has_archive'  => false,
        'rewrite'      => array('slug' => 'faq'),
        'show_in_rest' => true,
    );

    register_post_type('faq', $args);
}
add_action('init', 'register_cpt_faq');