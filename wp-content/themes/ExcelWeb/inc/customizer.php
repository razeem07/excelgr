<?php
function mytheme_customize_register( $wp_customize ) {

    // Add Section
    $wp_customize->add_section( 'mytheme_contact_section', [
        'title'       => __( 'Contact Info', 'mytheme' ),
        'priority'    => 30,
        'description' => __( 'Update your contact details here.', 'mytheme' ),
    ] );

    // Add Setting (Phone Number)
    $wp_customize->add_setting( 'mytheme_phone_number', [
        'default'           => '+971 55 341 5371',
        'sanitize_callback' => 'sanitize_text_field',
    ] );

    // Add Control (Phone Number Input)
    $wp_customize->add_control( 'mytheme_phone_number_control', [
        'label'    => __( 'Phone Number', 'mytheme' ),
        'section'  => 'mytheme_contact_section',
        'settings' => 'mytheme_phone_number',
        'type'     => 'text',
    ] );

}
add_action( 'customize_register', 'mytheme_customize_register' );


function mytheme_footer_customize_register( $wp_customize ) {

    // === Footer Section ===
    $wp_customize->add_section( 'footer_settings', array(
        'title'    => __( 'Footer Settings', 'mytheme' ),
        'priority' => 40,
    ) );

    // Footer Logo
    $wp_customize->add_setting( 'footer_logo' );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'footer_logo', array(
        'label'    => __( 'Footer Logo', 'mytheme' ),
        'section'  => 'footer_settings',
        'settings' => 'footer_logo',
    ) ) );

    // Footer Description
    $wp_customize->add_setting( 'footer_description', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_textarea_field',
    ) );
    $wp_customize->add_control( 'footer_description', array(
        'label'   => __( 'Footer Description', 'mytheme' ),
        'section' => 'footer_settings',
        'type'    => 'textarea',
    ) );

    // Address
    $wp_customize->add_setting( 'footer_address', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'footer_address', array(
        'label'   => __( 'Address', 'mytheme' ),
        'section' => 'footer_settings',
        'type'    => 'text',
    ) );

    // Phone
    $wp_customize->add_setting( 'footer_phone', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'footer_phone', array(
        'label'   => __( 'Phone Number', 'mytheme' ),
        'section' => 'footer_settings',
        'type'    => 'text',
    ) );

    // WhatsApp
    $wp_customize->add_setting( 'footer_whatsapp', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'footer_whatsapp', array(
        'label'   => __( 'WhatsApp Number', 'mytheme' ),
        'section' => 'footer_settings',
        'type'    => 'text',
    ) );

    // Email
    $wp_customize->add_setting( 'footer_email', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_email',
    ) );
    $wp_customize->add_control( 'footer_email', array(
        'label'   => __( 'Email Address', 'mytheme' ),
        'section' => 'footer_settings',
        'type'    => 'email',
    ) );

    // Email 2
    $wp_customize->add_setting( 'footer_email2', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_email',
    ) );
    $wp_customize->add_control( 'footer_email2', array(
        'label'   => __( 'Secondary Email Address', 'mytheme' ),
        'section' => 'footer_settings',
        'type'    => 'email',
    ) );

    // Website
    $wp_customize->add_setting( 'footer_website', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'footer_website', array(
        'label'   => __( 'Website URL', 'mytheme' ),
        'section' => 'footer_settings',
        'type'    => 'url',
    ) );

    // Social Links
    $socials = array( 'facebook', 'instagram', 'twitter', 'linkedin', 'youtube' );
    foreach ( $socials as $social ) {
        $wp_customize->add_setting( "footer_{$social}", array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        ) );
        $wp_customize->add_control( "footer_{$social}", array(
            'label'   => ucfirst( $social ) . ' URL',
            'section' => 'footer_settings',
            'type'    => 'url',
        ) );
    }

    // Copyright Text
    $wp_customize->add_setting( 'footer_copyright', array(
        'default' => '© ' . date("Y") . ' Prominent Leisure. All Rights Reserved.',
        'sanitize_callback' => 'wp_kses_post',
    ) );
    $wp_customize->add_control( 'footer_copyright', array(
        'label'   => __( 'Copyright Text', 'mytheme' ),
        'section' => 'footer_settings',
        'type'    => 'text',
    ) );

}
add_action( 'customize_register', 'mytheme_footer_customize_register' );


function bleizure_whatsapp_register( $wp_customize ) {
    // Section
    $wp_customize->add_section('bleizure_whatsapp_section', array(
        'title'       => __('WhatsApp Settings', 'bleizure'),
        'description' => __('Manage WhatsApp floating button', 'bleizure'),
        'priority'    => 160,
    ));

    // Setting: WhatsApp Number
    $wp_customize->add_setting('bleizure_whatsapp_number', array(
        'default'   => '971XXXXXXXXX',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    // Control: WhatsApp Number
    $wp_customize->add_control('bleizure_whatsapp_number_control', array(
        'label'    => __('WhatsApp Number (with country code)', 'bleizure'),
        'section'  => 'bleizure_whatsapp_section',
        'settings' => 'bleizure_whatsapp_number',
        'type'     => 'text',
    ));
}
add_action('customize_register', 'bleizure_whatsapp_register');


function mytheme_banner_register( $wp_customize ) {

    // Panel for Archive Banners
    $wp_customize->add_panel( 'archive_banners_panel', array(
        'title'       => __( 'Archive Banners', 'mytheme' ),
        'priority'    => 30,
        'description' => __( 'Manage banners for archive pages', 'mytheme' ),
    ));

    // Blog Banner
    $wp_customize->add_section( 'blog_banner', array(
        'title' => __( 'Blog Banner', 'mytheme' ),
        'panel' => 'archive_banners_panel',
    ));
    $wp_customize->add_setting( 'blog_banner_title', array( 'default' => 'Our Blog' ));
    $wp_customize->add_setting( 'blog_banner_desc', array( 'default' => 'Latest Updates, Travel Tips & News' ));
    $wp_customize->add_setting( 'blog_banner_image', array( 'default' => get_template_directory_uri() . '/assets/images/blog-banner.jpg' ));
    $wp_customize->add_control( 'blog_banner_title', array(
        'label' => 'Title', 'section' => 'blog_banner', 'type' => 'text'
    ));
    $wp_customize->add_control( 'blog_banner_desc', array(
        'label' => 'Description', 'section' => 'blog_banner', 'type' => 'text'
    ));
    $wp_customize->add_control( new WP_Customize_Image_Control(
        $wp_customize, 'blog_banner_image', array(
            'label'    => 'Banner Image',
            'section'  => 'blog_banner',
            'settings' => 'blog_banner_image'
        )
    ));

    // Services Banner
    $wp_customize->add_section( 'services_banner', array(
        'title' => __( 'Services Banner', 'mytheme' ),
        'panel' => 'archive_banners_panel',
    ));
    $wp_customize->add_setting( 'services_banner_title', array( 'default' => 'Our Services' ));
    $wp_customize->add_setting( 'services_banner_desc', array( 'default' => 'Discover Our Comprehensive Range of Solutions' ));
    $wp_customize->add_setting( 'services_banner_image', array( 'default' => get_template_directory_uri() . '/assets/images/services-banner.jpg' ));
    $wp_customize->add_control( 'services_banner_title', array(
        'label' => 'Title', 'section' => 'services_banner', 'type' => 'text'
    ));
    $wp_customize->add_control( 'services_banner_desc', array(
        'label' => 'Description', 'section' => 'services_banner', 'type' => 'text'
    ));
    $wp_customize->add_control( new WP_Customize_Image_Control(
        $wp_customize, 'services_banner_image', array(
            'label'    => 'Banner Image',
            'section'  => 'services_banner',
            'settings' => 'services_banner_image'
        )
    ));

    // Portfolio Banner
    $wp_customize->add_section( 'portfolio_banner', array(
        'title' => __( 'Portfolio Banner', 'mytheme' ),
        'panel' => 'archive_banners_panel',
    ));
    $wp_customize->add_setting( 'portfolio_banner_title', array( 'default' => 'Our Portfolio' ));
    $wp_customize->add_setting( 'portfolio_banner_desc', array( 'default' => 'Explore Our Recent Work & Projects' ));
    $wp_customize->add_setting( 'portfolio_banner_image', array( 'default' => get_template_directory_uri() . '/assets/images/portfolio-banner.jpg' ));
    $wp_customize->add_control( 'portfolio_banner_title', array(
        'label' => 'Title', 'section' => 'portfolio_banner', 'type' => 'text'
    ));
    $wp_customize->add_control( 'portfolio_banner_desc', array(
        'label' => 'Description', 'section' => 'portfolio_banner', 'type' => 'text'
    ));
    $wp_customize->add_control( new WP_Customize_Image_Control(
        $wp_customize, 'portfolio_banner_image', array(
            'label'    => 'Banner Image',
            'section'  => 'portfolio_banner',
            'settings' => 'portfolio_banner_image'
        )
    ));
}
add_action( 'customize_register', 'mytheme_banner_register' );