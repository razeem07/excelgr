<?php
// AUTO-GENERATED from live ACF DB records. Do not hand-edit field shapes;
// regenerate via scratchpad/generate_manifest.php if ACF data changes before cutover.
// Nested by context (page ID or post type) then field name, since the same
// field name is legitimately reused across different pages/post types.

function bleizure_field_manifest() {
	static $manifest = null;
	if ( $manifest !== null ) return $manifest;
	$manifest = array(
		'page:5' => array(
			'screen' => array('post_type' => 'page', 'post_id' => 5),
			'fields' => array(
				'who_we_are' => array(
					'group_title' => 'Home Page Settings',
					'label' => 'Who We Are',
					'fields' => array(
						'title' => array(
							'label' => 'Title',
							'type' => 'text',
						),
						'content' => array(
							'label' => 'Content',
							'type' => 'text',
						),
						'card_1' => array(
							'label' => 'Card 1',
							'fields' => array(
										'content' => array(
											'label' => 'Content',
											'type' => 'text',
										),
										'icon' => array(
											'label' => 'Icon',
											'type' => 'image',
										),
							),
						),
						'card_2' => array(
							'label' => 'Card 2',
							'fields' => array(
										'content' => array(
											'label' => 'Content',
											'type' => 'text',
										),
										'icon' => array(
											'label' => 'Icon',
											'type' => 'image',
										),
							),
						),
						'card_3' => array(
							'label' => 'Card 3',
							'fields' => array(
										'content' => array(
											'label' => 'Content',
											'type' => 'text',
										),
										'icon' => array(
											'label' => 'Icon',
											'type' => 'image',
										),
							),
						),
					),
				),
				'who_we_are_2' => array(
					'group_title' => 'Home Page Settings',
					'label' => 'Who We Are 2',
					'fields' => array(
						'title' => array(
							'label' => 'Title',
							'type' => 'text',
						),
						'content' => array(
							'label' => 'Content',
							'type' => 'text',
						),
						'card_1' => array(
							'label' => 'Card 1',
							'fields' => array(
										'title' => array(
											'label' => 'Title',
											'type' => 'text',
										),
										'icon' => array(
											'label' => 'Icon',
											'type' => 'image',
										),
							),
						),
						'card_2' => array(
							'label' => 'Card 2',
							'fields' => array(
										'title' => array(
											'label' => 'Title',
											'type' => 'text',
										),
										'icon' => array(
											'label' => 'Icon',
											'type' => 'image',
										),
							),
						),
						'card_3' => array(
							'label' => 'Card 3',
							'fields' => array(
										'title' => array(
											'label' => 'Title',
											'type' => 'text',
										),
										'icon' => array(
											'label' => 'Icon',
											'type' => 'image',
										),
							),
						),
						'card_4' => array(
							'label' => 'Card 4',
							'fields' => array(
										'title' => array(
											'label' => 'Title',
											'type' => 'text',
										),
										'icon' => array(
											'label' => 'Icon',
											'type' => 'image',
										),
							),
						),
						'card_5' => array(
							'label' => 'Card 5',
							'fields' => array(
										'title' => array(
											'label' => 'Title',
											'type' => 'text',
										),
										'icon' => array(
											'label' => 'Icon',
											'type' => 'image',
										),
							),
						),
					),
				),
				'scale' => array(
					'group_title' => 'Home Page Settings',
					'label' => 'Scale',
					'fields' => array(
						'title' => array(
							'label' => 'Title',
							'type' => 'text',
						),
						'content' => array(
							'label' => 'Content',
							'type' => 'text',
						),
						'image' => array(
							'label' => 'Image',
							'type' => 'image',
						),
						'exp' => array(
							'label' => 'Exp',
							'type' => 'text',
						),
						'customers' => array(
							'label' => 'Customers',
							'type' => 'text',
						),
						'percentage' => array(
							'label' => 'Percentage',
							'type' => 'text',
						),
						'employees' => array(
							'label' => 'Employees',
							'type' => 'text',
						),
					),
				),
				'selected_work' => array(
					'group_title' => 'Home Page Settings',
					'label' => 'Selected Work',
					'fields' => array(
						'title' => array(
							'label' => 'Section Heading (above all 4 cards)',
							'type' => 'text',
						),
						'card_1_title' => array( 'label' => 'Card 1 Project Title', 'type' => 'text' ),
						'image' => array( 'label' => 'Card 1 Image', 'type' => 'image' ),
						'card_2_title' => array( 'label' => 'Card 2 Project Title', 'type' => 'text' ),
						'image_2' => array( 'label' => 'Card 2 Image', 'type' => 'image' ),
						'card_3_title' => array( 'label' => 'Card 3 Project Title', 'type' => 'text' ),
						'image_3' => array( 'label' => 'Card 3 Image', 'type' => 'image' ),
						'card_4_title' => array( 'label' => 'Card 4 Project Title', 'type' => 'text' ),
						'image_4' => array( 'label' => 'Card 4 Image', 'type' => 'image' ),
					),
				),
				'clients_logo' => array(
					'group_title' => 'Home Page Settings',
					'label' => 'Clients Logo',
					'type' => 'image',
				),
				'cta_section' => array(
					'group_title' => 'Home Page Settings',
					'label' => 'CTA Section',
					'fields' => array(
						'title' => array(
							'label' => 'Title',
							'type' => 'text',
						),
						'link' => array(
							'label' => 'link',
							'type' => 'text',
						),
						'image' => array(
							'label' => 'Image',
							'type' => 'image',
						),
					),
				),
			),
		),
		'posttype:testimonial' => array(
			'screen' => array('post_type' => 'testimonial'),
			'fields' => array(
				'designation' => array(
					'group_title' => 'Testimonials Additional Fields',
					'label' => 'Designation',
					'type' => 'text',
				),
			),
		),
		'posttype:portfolio' => array(
			'screen' => array('post_type' => 'portfolio'),
			'fields' => array(
				'service_category' => array(
					'group_title' => 'Portfolio Additional Fields',
					'label' => 'Service Category (e.g. "3D Signage", "Storefront Branding")',
					'type' => 'text',
				),
				'gallery' => array(
					'group_title' => 'Portfolio Additional Fields',
					'label' => 'Gallery Images (shown in the View Work lightbox; falls back to the Featured Image if empty)',
					'type' => 'gallery',
				),
			),
		),
		'page:153' => array(
			'screen' => array('post_type' => 'page', 'post_id' => 153),
			'fields' => array(
				'about_banner' => array(
					'group_title' => 'About Page Settings',
					'label' => 'About Banner',
					'fields' => array(
						'banner_image' => array(
							'label' => 'Banner Image',
							'type' => 'image',
						),
						'subtitle' => array(
							'label' => 'Subtitle',
							'type' => 'text',
						),
						'title' => array(
							'label' => 'Title',
							'type' => 'text',
						),
						'content' => array(
							'label' => 'Content',
							'type' => 'text',
						),
					),
				),
				'who_we_are' => array(
					'group_title' => 'About Page Settings',
					'label' => 'About Intro (badge, heading, description, image, 4 stats)',
					'fields' => array(
						'subtitle' => array(
							'label' => 'Badge Text (e.g. "About Excel Graphics")',
							'type' => 'text',
						),
						'heading' => array(
							'label' => 'Heading',
							'type' => 'text',
						),
						'description' => array(
							'label' => 'Description',
							'type' => 'text',
						),
						'image' => array(
							'label' => 'Image',
							'type' => 'image',
						),
						'stat_1' => array(
							'label' => 'Stat 1',
							'fields' => array(
								'number' => array( 'label' => 'Number (e.g. "20+")', 'type' => 'text' ),
								'label' => array( 'label' => 'Label', 'type' => 'text' ),
							),
						),
						'stat_2' => array(
							'label' => 'Stat 2',
							'fields' => array(
								'number' => array( 'label' => 'Number', 'type' => 'text' ),
								'label' => array( 'label' => 'Label', 'type' => 'text' ),
							),
						),
						'stat_3' => array(
							'label' => 'Stat 3',
							'fields' => array(
								'number' => array( 'label' => 'Number', 'type' => 'text' ),
								'label' => array( 'label' => 'Label', 'type' => 'text' ),
							),
						),
						'stat_4' => array(
							'label' => 'Stat 4',
							'fields' => array(
								'number' => array( 'label' => 'Number', 'type' => 'text' ),
								'label' => array( 'label' => 'Label', 'type' => 'text' ),
							),
						),
					),
				),
				'about_purpose' => array(
					'group_title' => 'About Page Settings',
					'label' => 'Our Purpose (badge, heading, image, intro text, button)',
					'fields' => array(
						'badge' => array( 'label' => 'Badge Text (e.g. "Our Purpose")', 'type' => 'text' ),
						'heading' => array( 'label' => 'Heading', 'type' => 'text' ),
						'image' => array( 'label' => 'Image', 'type' => 'image' ),
						'intro_text' => array( 'label' => 'Intro Text', 'type' => 'text' ),
						'button_text' => array( 'label' => 'Button Text', 'type' => 'text' ),
						'button_link' => array( 'label' => 'Button Link', 'type' => 'text' ),
					),
				),
				'about_why_choose' => array(
					'group_title' => 'About Page Settings',
					'label' => 'Why Choose Us (badge, heading, description, image, 4 features, mini CTA)',
					'fields' => array(
						'badge' => array( 'label' => 'Badge Text (e.g. "Why Choose Us")', 'type' => 'text' ),
						'heading' => array( 'label' => 'Heading', 'type' => 'text' ),
						'description' => array( 'label' => 'Description', 'type' => 'text' ),
						'image' => array( 'label' => 'Image', 'type' => 'image' ),
						'feature_1' => array(
							'label' => 'Feature 1',
							'fields' => array(
								'icon' => array( 'label' => 'Icon (emoji/symbol)', 'type' => 'text' ),
								'title' => array( 'label' => 'Title', 'type' => 'text' ),
								'description' => array( 'label' => 'Description', 'type' => 'text' ),
							),
						),
						'feature_2' => array(
							'label' => 'Feature 2',
							'fields' => array(
								'icon' => array( 'label' => 'Icon (emoji/symbol)', 'type' => 'text' ),
								'title' => array( 'label' => 'Title', 'type' => 'text' ),
								'description' => array( 'label' => 'Description', 'type' => 'text' ),
							),
						),
						'feature_3' => array(
							'label' => 'Feature 3',
							'fields' => array(
								'icon' => array( 'label' => 'Icon (emoji/symbol)', 'type' => 'text' ),
								'title' => array( 'label' => 'Title', 'type' => 'text' ),
								'description' => array( 'label' => 'Description', 'type' => 'text' ),
							),
						),
						'feature_4' => array(
							'label' => 'Feature 4',
							'fields' => array(
								'icon' => array( 'label' => 'Icon (emoji/symbol)', 'type' => 'text' ),
								'title' => array( 'label' => 'Title', 'type' => 'text' ),
								'description' => array( 'label' => 'Description', 'type' => 'text' ),
							),
						),
						'cta_text' => array( 'label' => 'Mini CTA Text', 'type' => 'text' ),
						'cta_link_text' => array( 'label' => 'Mini CTA Link Text', 'type' => 'text' ),
						'cta_link' => array( 'label' => 'Mini CTA Link URL', 'type' => 'text' ),
						'cta_image' => array( 'label' => 'Mini CTA Background Image', 'type' => 'image' ),
					),
				),
				'group_photo' => array(
					'group_title' => 'About Page Settings',
					'label' => 'Group Photo',
					'type' => 'image',
				),
				'owner' => array(
					'group_title' => 'About Page Settings',
					'label' => 'Owner',
					'fields' => array(
						'image' => array(
							'label' => 'image',
							'type' => 'image',
						),
						'title' => array(
							'label' => 'title',
							'type' => 'text',
						),
						'content' => array(
							'label' => 'content',
							'type' => 'text',
						),
						'achievements' => array(
							'label' => 'Achievements',
							'type' => 'wysiwyg',
						),
					),
				),
				'mission_section' => array(
					'group_title' => 'About Page Settings',
					'label' => 'Our Mission (small card: icon, title, description)',
					'fields' => array(
						'icon' => array( 'label' => 'Icon (emoji/symbol)', 'type' => 'text' ),
						'title' => array( 'label' => 'Title', 'type' => 'text' ),
						'description' => array( 'label' => 'Description', 'type' => 'text' ),
					),
				),
				'vision_section' => array(
					'group_title' => 'About Page Settings',
					'label' => 'Our Vision (small card: icon, title, description)',
					'fields' => array(
						'icon' => array( 'label' => 'Icon (emoji/symbol)', 'type' => 'text' ),
						'title' => array( 'label' => 'Title', 'type' => 'text' ),
						'description' => array( 'label' => 'Description', 'type' => 'text' ),
					),
				),
			),
		),
		'page:190' => array(
			'screen' => array('post_type' => 'page', 'post_id' => 190),
			'fields' => array(
				'contact_banner' => array(
					'group_title' => 'Contact Page Settings',
					'label' => 'Contact Banner',
					'fields' => array(
						'subtitle' => array(
							'label' => 'subtitle',
							'type' => 'text',
						),
						'title' => array(
							'label' => 'title',
							'type' => 'text',
						),
						'content' => array(
							'label' => 'content',
							'type' => 'text',
						),
						'image' => array(
							'label' => 'image',
							'type' => 'image',
						),
					),
				),
			),
		),
		'page:205' => array(
			'screen' => array('post_type' => 'page', 'post_id' => 205),
			'fields' => array(
				'blog_banner' => array(
					'group_title' => 'Blogs Page Settings',
					'label' => 'Blog Banner',
					'fields' => array(
						'subtitle' => array(
							'label' => 'subtitle',
							'type' => 'text',
						),
						'title' => array(
							'label' => 'title',
							'type' => 'text',
						),
						'content' => array(
							'label' => 'content',
							'type' => 'text',
						),
						'banner_image' => array(
							'label' => 'banner image',
							'type' => 'image',
						),
					),
				),
			),
		),
		'page:196' => array(
			'screen' => array('post_type' => 'page', 'post_id' => 196),
			'fields' => array(
				'services_banner' => array(
					'group_title' => 'Services Page Settings',
					'label' => 'Services Banner',
					'fields' => array(
						'subtitle' => array(
							'label' => 'subtitle',
							'type' => 'text',
						),
						'title' => array(
							'label' => 'title',
							'type' => 'text',
						),
						'content' => array(
							'label' => 'content',
							'type' => 'text',
						),
						'image' => array(
							'label' => 'image',
							'type' => 'image',
						),
					),
				),
			),
		),
		'page:199' => array(
			'screen' => array('post_type' => 'page', 'post_id' => 199),
			'fields' => array(
				'portfolio_banner' => array(
					'group_title' => 'Portfolio Page Settings',
					'label' => 'Portfolio Banner',
					'fields' => array(
						'subtitle' => array(
							'label' => 'subtitle',
							'type' => 'text',
						),
						'title' => array(
							'label' => 'title',
							'type' => 'text',
						),
						'content' => array(
							'label' => 'content',
							'type' => 'text',
						),
						'image' => array(
							'label' => 'image',
							'type' => 'image',
						),
					),
				),
			),
		),
		'page:248' => array(
			'screen' => array('post_type' => 'page', 'post_id' => 248),
			'fields' => array(
				'gallery_banner' => array(
					'group_title' => 'Gallery Page Settings',
					'label' => 'Gallery Banner',
					'fields' => array(
						'subtitle' => array(
							'label' => 'subtitle',
							'type' => 'text',
						),
						'title' => array(
							'label' => 'title',
							'type' => 'text',
						),
						'content' => array(
							'label' => 'content',
							'type' => 'text',
						),
						'image' => array(
							'label' => 'image',
							'type' => 'image',
						),
					),
				),
			),
		),
		'page:370' => array(
			'screen' => array('post_type' => 'page', 'post_id' => 370),
			'fields' => array(
				'clients_banner' => array(
					'group_title' => 'Clients Page Settings',
					'label' => 'Clients Banner',
					'fields' => array(
						'subtitle' => array(
							'label' => 'subtitle',
							'type' => 'text',
						),
						'title' => array(
							'label' => 'title',
							'type' => 'text',
						),
						'content' => array(
							'label' => 'content',
							'type' => 'text',
						),
						'image' => array(
							'label' => 'image',
							'type' => 'image',
						),
					),
				),
			),
		),
		'page:271' => array(
			'screen' => array('post_type' => 'page', 'post_id' => 271),
			'fields' => array(
				'process_banner' => array(
					'group_title' => 'Our Process Page',
					'label' => 'process banner',
					'fields' => array(
						'subtitle' => array(
							'label' => 'subtitle',
							'type' => 'text',
						),
						'title' => array(
							'label' => 'title',
							'type' => 'text',
						),
						'content' => array(
							'label' => 'content',
							'type' => 'text',
						),
						'image' => array(
							'label' => 'image',
							'type' => 'image',
						),
					),
				),
				'video_link' => array(
					'group_title' => 'Our Process Page',
					'label' => 'Video Link (YouTube video ID, e.g. dQw4w9WgXcQ)',
					'type' => 'text',
				),
				'process_video_banner_image' => array(
					'group_title' => 'Our Process Page',
					'label' => 'Video Section Background Image',
					'type' => 'image',
				),
				'process_intro' => array(
					'group_title' => 'Our Process Page',
					'label' => 'Process Section Intro',
					'fields' => array(
						'badge' => array( 'label' => 'Badge Text', 'type' => 'text' ),
						'title' => array( 'label' => 'Section Title', 'type' => 'text' ),
						'description' => array( 'label' => 'Description', 'type' => 'text' ),
					),
				),
				'step_1' => array(
					'group_title' => 'Our Process Page',
					'label' => 'Step 1',
					'fields' => array(
						'icon' => array( 'label' => 'Icon (emoji/symbol)', 'type' => 'text' ),
						'title' => array( 'label' => 'Title', 'type' => 'text' ),
						'description' => array( 'label' => 'Description', 'type' => 'text' ),
					),
				),
				'step_2' => array(
					'group_title' => 'Our Process Page',
					'label' => 'Step 2',
					'fields' => array(
						'icon' => array( 'label' => 'Icon (emoji/symbol)', 'type' => 'text' ),
						'title' => array( 'label' => 'Title', 'type' => 'text' ),
						'description' => array( 'label' => 'Description', 'type' => 'text' ),
					),
				),
				'step_3' => array(
					'group_title' => 'Our Process Page',
					'label' => 'Step 3',
					'fields' => array(
						'icon' => array( 'label' => 'Icon (emoji/symbol)', 'type' => 'text' ),
						'title' => array( 'label' => 'Title', 'type' => 'text' ),
						'description' => array( 'label' => 'Description', 'type' => 'text' ),
					),
				),
				'step_4' => array(
					'group_title' => 'Our Process Page',
					'label' => 'Step 4',
					'fields' => array(
						'icon' => array( 'label' => 'Icon (emoji/symbol)', 'type' => 'text' ),
						'title' => array( 'label' => 'Title', 'type' => 'text' ),
						'description' => array( 'label' => 'Description', 'type' => 'text' ),
					),
				),
				'step_5' => array(
					'group_title' => 'Our Process Page',
					'label' => 'Step 5',
					'fields' => array(
						'icon' => array( 'label' => 'Icon (emoji/symbol)', 'type' => 'text' ),
						'title' => array( 'label' => 'Title', 'type' => 'text' ),
						'description' => array( 'label' => 'Description', 'type' => 'text' ),
					),
				),
				'step_6' => array(
					'group_title' => 'Our Process Page',
					'label' => 'Step 6',
					'fields' => array(
						'icon' => array( 'label' => 'Icon (emoji/symbol)', 'type' => 'text' ),
						'title' => array( 'label' => 'Title', 'type' => 'text' ),
						'description' => array( 'label' => 'Description', 'type' => 'text' ),
					),
				),
				'step_7' => array(
					'group_title' => 'Our Process Page',
					'label' => 'Step 7',
					'fields' => array(
						'icon' => array( 'label' => 'Icon (emoji/symbol)', 'type' => 'text' ),
						'title' => array( 'label' => 'Title', 'type' => 'text' ),
						'description' => array( 'label' => 'Description', 'type' => 'text' ),
					),
				),
				'step_8' => array(
					'group_title' => 'Our Process Page',
					'label' => 'Step 8',
					'fields' => array(
						'icon' => array( 'label' => 'Icon (emoji/symbol)', 'type' => 'text' ),
						'title' => array( 'label' => 'Title', 'type' => 'text' ),
						'description' => array( 'label' => 'Description', 'type' => 'text' ),
					),
				),
				'quality_intro' => array(
					'group_title' => 'Our Process Page',
					'label' => 'Quality Section Intro',
					'fields' => array(
						'badge' => array( 'label' => 'Badge Text', 'type' => 'text' ),
						'title' => array( 'label' => 'Section Title', 'type' => 'text' ),
					),
				),
				'quality_feature_1' => array(
					'group_title' => 'Our Process Page',
					'label' => 'Quality Feature 1',
					'fields' => array(
						'icon' => array( 'label' => 'Icon (emoji/symbol)', 'type' => 'text' ),
						'title' => array( 'label' => 'Title', 'type' => 'text' ),
						'description' => array( 'label' => 'Description', 'type' => 'text' ),
					),
				),
				'quality_feature_2' => array(
					'group_title' => 'Our Process Page',
					'label' => 'Quality Feature 2',
					'fields' => array(
						'icon' => array( 'label' => 'Icon (emoji/symbol)', 'type' => 'text' ),
						'title' => array( 'label' => 'Title', 'type' => 'text' ),
						'description' => array( 'label' => 'Description', 'type' => 'text' ),
					),
				),
				'quality_feature_3' => array(
					'group_title' => 'Our Process Page',
					'label' => 'Quality Feature 3',
					'fields' => array(
						'icon' => array( 'label' => 'Icon (emoji/symbol)', 'type' => 'text' ),
						'title' => array( 'label' => 'Title', 'type' => 'text' ),
						'description' => array( 'label' => 'Description', 'type' => 'text' ),
					),
				),
				'process_cta' => array(
					'group_title' => 'Our Process Page',
					'label' => 'Call To Action Banner',
					'fields' => array(
						'image' => array( 'label' => 'Background Image', 'type' => 'image' ),
						'title' => array( 'label' => 'Title', 'type' => 'text' ),
						'subtitle' => array( 'label' => 'Subtitle', 'type' => 'text' ),
						'contact_text' => array( 'label' => 'Contact Text', 'type' => 'text' ),
					),
				),
			),
		),
		'posttype:post' => array(
			'screen' => array('post_type' => 'post'),
			'fields' => array(
				'post_banner_image' => array(
					'group_title' => 'Blog Post Settings',
					'label' => 'Banner Image (used on the post detail hero — separate from the Featured Image used on listing cards)',
					'type' => 'image',
				),
			),
		),
		'posttype:service' => array(
			'screen' => array('post_type' => 'service'),
			'fields' => array(
				'service_banner_image' => array(
					'group_title' => 'Single Services Settings',
					'label' => 'Banner Image (used on the service detail hero — separate from the Featured Image used on listing cards)',
					'type' => 'image',
				),
				'services_faq' => array(
					'group_title' => 'Single Services Settings',
					'label' => 'Services FAQ',
					'type' => 'wysiwyg',
				),
			),
		),
		'posttype:banner' => array(
			'screen' => array('post_type' => 'banner'),
			'fields' => array(
				'banner_content' => array(
					'group_title' => 'Banner Content',
					'label' => 'Banner Content',
					'fields' => array(
						'headline' => array(
							'label' => 'Headline (HTML allowed, e.g. <br> for line breaks)',
							'type' => 'text',
						),
						'description' => array(
							'label' => 'Description',
							'type' => 'text',
						),
						'badge_title' => array(
							'label' => 'Badge Title (e.g. "SINCE 2002") — optional',
							'type' => 'text',
						),
						'badge_content' => array(
							'label' => 'Badge Subtext — optional',
							'type' => 'text',
						),
						'view_project_button' => array(
							'label' => 'View Project Button URL',
							'type' => 'text',
						),
						'reach_out_button' => array(
							'label' => 'Reach Out Button URL',
							'type' => 'text',
						),
					),
				),
			),
		),
	);
	return $manifest;
}
