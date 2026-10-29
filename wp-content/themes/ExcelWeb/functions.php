<?php

 require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';

 require get_template_directory() . '/inc/customizer.php';


// Load Bootstrap + Theme CSS
function mytheme_enqueue_styles() {
    // Bootstrap
    wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css');

    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js');

     // Bootstrap Icons
    wp_enqueue_style('bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css');


      // Google Fonts - Sora
    wp_enqueue_style('mytheme-google-fonts','https://fonts.googleapis.com/css2?family=Sora:wght@100..800&display=swap',array(),null);


    // AOS CSS
    wp_enqueue_style('aos-css','https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css',array(),'2.3.4');
    


     // AOS JS
    wp_enqueue_script('aos-js','https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js',array(),'2.3.4',true);
    
    
        //Swiper

    wp_enqueue_style('swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css');
    wp_enqueue_script('swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), null, true);

    // Desktop CSS (default)
    wp_enqueue_style('desktop-css', get_template_directory_uri() . '/assets/css/main.css');

    // Theme style.css (required by WordPress, can be empty or minimal)
    wp_enqueue_style('theme-style', get_stylesheet_uri());

   
     // Custom JS (your own scripts)
    wp_enqueue_script('custom-js', get_template_directory_uri() . '/assets/js/main.js', ['jquery']);
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_styles');





// Add Theme Support


function mytheme_setup() {
    add_theme_support( 'title-tag' );
      add_theme_support('site-icon');


    // Enable support for custom logo
    add_theme_support( 'custom-logo', array(
        'height'      => 100,   // Suggested height
        'width'       => 300,   // Suggested width
        'flex-height' => true,  // Allow flexible height
        'flex-width'  => true,  // Allow flexible width
    ) );


    add_theme_support('post-thumbnails');


   
}
add_action( 'after_setup_theme', 'mytheme_setup' );

//add excerpt
function add_excerpt_support_for_pages() {
    add_post_type_support('page', 'excerpt');
}
add_action('init', 'add_excerpt_support_for_pages');



// Reegister Menu

function bleizure_register_menus() {
    register_nav_menus([
        'primary_menu' => __('Primary Menu', 'bleizure'),
        'footer_services' => __('Footer Services', 'mytheme'),
        'secondary_menu' => __('Secondary Menu', 'mytheme'),
    ]);
}
add_action('after_setup_theme', 'bleizure_register_menus');




// Add classes to <a> tags for the footer services menu
function mytheme_footer_services_link_classes( $atts, $item, $args ) {
  if ( isset($args->theme_location) && $args->theme_location === 'footer_services' ) {
    // keep your exact classes
    $existing = isset($atts['class']) ? $atts['class'].' ' : '';
    $atts['class'] = $existing . 'text-dark text-decoration-none';
  }
  return $atts;
}
add_filter('nav_menu_link_attributes', 'mytheme_footer_services_link_classes', 10, 3);


// Add custom classes to footer secondary (Quick Links) menu <a> tags
function mytheme_footer_secondary_link_classes( $atts, $item, $args ) {
  if ( isset($args->theme_location) && $args->theme_location === 'secondary_menu' ) {
    $existing = isset($atts['class']) ? $atts['class'].' ' : '';
    $atts['class'] = $existing . 'text-dark text-decoration-none';
  }
  return $atts;
}
add_filter('nav_menu_link_attributes', 'mytheme_footer_secondary_link_classes', 10, 3);


// Service page SEO. Yoast owns the title, meta description and breadcrumb; this
// adds what Yoast doesn't generate for these pages — a Service piece and the
// FAQ (WebPage becomes WebPage + FAQPage, same as Yoast's own FAQ block) —
// into Yoast's single schema graph. Page-level extras (H1, FAQ heading, CTA,
// starting prices) come from the "SEO Settings" fields on each service.
function mytheme_service_seo( $key, $post_id = 0 ) {
  $post_id = $post_id ? $post_id : get_queried_object_id();
  return trim( (string) get_post_meta( $post_id, 'service_seo_' . $key, true ) );
}

// Split the services_faq WYSIWYG into question/answer pairs: each <strong>
// (or <b>) starts a question, and everything up to the next one is its answer.
function mytheme_service_faq_items( $post_id ) {
  $raw   = get_field( 'services_faq', $post_id );
  $items = array();
  if ( empty( $raw ) ) {
    return $items;
  }
  $pattern = '/<(strong|b)[^>]*>(.*?)<\/\1>\s*([\s\S]*?)(?=(?:<(?:strong|b)[^>]*>|$))/i';
  if ( preg_match_all( $pattern, $raw, $matches, PREG_SET_ORDER ) ) {
    foreach ( $matches as $match ) {
      $question = trim( strip_tags( $match[2] ) );
      $answer   = trim( preg_replace( '/^<\/p>|<p>$/i', '', trim( $match[3] ) ) );
      if ( ! empty( $question ) ) {
        $items[] = array( 'question' => $question, 'answer' => $answer );
      }
    }
  }
  return $items;
}

// Services is a regular page, not the CPT archive, so Yoast leaves it out of
// service breadcrumbs: Home > Services > [parent service] > service.
function mytheme_service_breadcrumb_links( $crumbs ) {
  $services_page = get_page_by_path( 'services' );
  if ( is_singular( 'service' ) && $services_page && count( $crumbs ) > 1 ) {
    array_splice( $crumbs, 1, 0, array( array(
      'url'  => get_permalink( $services_page ),
      'text' => get_the_title( $services_page ),
      'id'   => $services_page->ID,
    ) ) );
  }
  return $crumbs;
}
add_filter( 'wpseo_breadcrumb_links', 'mytheme_service_breadcrumb_links' );

function mytheme_service_faq_question_id( $context, $index ) {
  return $context->canonical . '#faq-question-' . ( $index + 1 );
}

function mytheme_service_schema_webpage( $piece, $context ) {
  if ( ! is_singular( 'service' ) ) {
    return $piece;
  }
  $faq_items = mytheme_service_faq_items( $context->id );
  if ( $faq_items ) {
    $piece['@type']      = array_values( array_unique( array_merge( (array) $piece['@type'], array( 'FAQPage' ) ) ) );
    $piece['mainEntity'] = array();
    foreach ( $faq_items as $i => $item ) {
      $piece['mainEntity'][] = array( '@id' => mytheme_service_faq_question_id( $context, $i ) );
    }
  }
  return $piece;
}
add_filter( 'wpseo_schema_webpage', 'mytheme_service_schema_webpage', 10, 2 );

function mytheme_service_schema_graph( $graph, $context ) {
  if ( ! is_singular( 'service' ) ) {
    return $graph;
  }
  $post_id = $context->id;
  $url     = $context->canonical;

  $service = array(
    '@type'            => 'Service',
    '@id'              => $url . '#service',
    'name'             => mytheme_service_seo( 'heading', $post_id ) ? mytheme_service_seo( 'heading', $post_id ) : get_the_title( $post_id ),
    'description'      => $context->description ? $context->description : wp_trim_words( wp_strip_all_tags( get_post_field( 'post_content', $post_id ) ), 30, '...' ),
    'url'              => $url,
    'mainEntityOfPage' => array( '@id' => $context->main_schema_id ),
    'areaServed'       => array( '@type' => 'City', 'name' => 'Kollam' ),
  );
  if ( $context->site_represents_reference ) {
    $service['provider'] = $context->site_represents_reference;
  }

  $offers = array();
  foreach ( array_filter( array_map( 'trim', explode( ';', mytheme_service_seo( 'schema_offers', $post_id ) ) ) ) as $offer ) {
    $parts = array_map( 'trim', explode( '|', $offer ) );
    if ( 2 === count( $parts ) && is_numeric( $parts[1] ) ) {
      $offers[] = array(
        '@type'              => 'Offer',
        'name'               => $parts[0],
        'priceSpecification' => array( '@type' => 'PriceSpecification', 'minPrice' => (float) $parts[1], 'priceCurrency' => 'INR' ),
      );
    }
  }
  if ( $offers ) {
    $service['offers'] = $offers;
  }
  $graph[] = $service;

  foreach ( mytheme_service_faq_items( $post_id ) as $i => $item ) {
    $graph[] = array(
      '@type'          => 'Question',
      '@id'            => mytheme_service_faq_question_id( $context, $i ),
      'position'       => $i + 1,
      'url'            => mytheme_service_faq_question_id( $context, $i ),
      'name'           => $item['question'],
      'answerCount'    => 1,
      'acceptedAnswer' => array( '@type' => 'Answer', 'text' => trim( preg_replace( '/\s+/', ' ', wp_strip_all_tags( $item['answer'] ) ) ) ),
    );
  }
  return $graph;
}
add_filter( 'wpseo_schema_graph', 'mytheme_service_schema_graph', 10, 2 );
