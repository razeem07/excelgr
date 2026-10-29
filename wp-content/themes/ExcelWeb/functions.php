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











