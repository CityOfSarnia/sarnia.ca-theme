<?php

	// Custom Except Length
	function sarnia_excerpt_length( $length ) {
		return 20;
	}
	add_filter( 'excerpt_length', 'sarnia_excerpt_length' );
	
	// Define Post Thumbnails
	add_theme_support( 'post-thumbnails');
	add_image_size( 'home-banner', 1000, 900, true );
	add_image_size( 'banner', 1600, 600, true );
		    
	// Add Theme Features
	add_post_type_support( 'page', 'excerpt' );
	
	// Register Main Menu 
	add_action( 'init', 'register_my_menu' );

	function register_my_menu() {
		register_nav_menu( 'primary-menu', __( 'Primary Menu' ) );
		register_nav_menu( 'footer-menu', __( 'Footer Menu' ) );
	}
	
	// Register Options Page
	if( function_exists('acf_add_options_page') ) {
		acf_add_options_page();
	}

	// Add theme support for wide content alignment
	function sarnia_setup() {
		add_theme_support( 'align-wide' );
		add_theme_support( 'editor-color-palette' );
		add_theme_support( 'disable-custom-colors' );
		add_theme_support('disable-custom-font-sizes');
		add_theme_support( 'responsive-embeds' );
	}
	add_action( 'after_setup_theme', 'sarnia_setup' );

	// Limit the core blocks
	add_filter( 'allowed_block_types', 'sarnia_allowed_block_types' );
	function sarnia_allowed_block_types( $allowed_blocks ) {
		return array(
			'core/image',
			'core/paragraph',
			'core/heading',
			// 'core/list',
			'core/gallery',
			'core/table',
			'core/columns',
			'acf/post-card',
			'acf/custom-card',
			'acf/banner',
			'acf/notifications',
			'acf/navigation',
			'acf/recent-posts'
			//'core/video',
			//'core/embed',
			//'core-embed/youtube'
		);
	}

	// Edit the editor font sizes
	add_theme_support( 'editor-font-sizes', array(
		array(
			'name'      => __( 'small', 'sarnia' ),
			'shortName' => __( 'S', 'sarnia' ),
			'size'      => 14,
			'slug'      => 'small'
		),
		array(
			'name'      => __( 'regular', 'sarnia' ),
			'shortName' => __( 'M', 'sarnia' ),
			'size'      => 16,
			'slug'      => 'regular'
		),
		array(
			'name'      => __( 'large', 'sarnia' ),
			'shortName' => __( 'L', 'sarnia' ),
			'size'      => 20,
			'slug'      => 'large'
		)
	) );


	// Theme Fonts URL
	function sarnia_theme_fonts_url() {
		$font_families = apply_filters( 'sarnia_theme_fonts', array( 'Open+Sans:300,300i,400,600|Playfair+Display' ) );
		$query_args = array(
			'family' => implode( '|', $font_families ),
			'subset' => 'latin,latin-ext',
		);
		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
		return esc_url_raw( $fonts_url );
	}

	add_action('acf/init', 'my_acf_init');
	function my_acf_init() {
		
		// check function exists
		if( function_exists('acf_register_block') ) {

			// register a banner block
			acf_register_block(array(
				'name'						=> 'banner',
				'title'						=> __('Banner'),
				'description'			=> __('A banner block.'),
				'render_callback'	=> 'my_acf_block_render_callback',
				'category'				=> 'formatting',
				'icon'						=> 'admin-comments',
				'keywords'				=> array( 'banner', 'menu', 'nav' ),
			));

			// register a post card block
			acf_register_block(array(
				'name'						=> 'post-card',
				'title'						=> __('Post Card'),
				'description'			=> __('A post or page card block.'),
				'render_callback'	=> 'my_acf_block_render_callback',
				'category'				=> 'formatting',
				'icon'						=> 'admin-comments',
				'keywords'				=> array( 'post', 'card' ),
			));

			// register a custom card block
			acf_register_block(array(
				'name'						=> 'custom-card',
				'title'						=> __('Custom Card'),
				'description'			=> __('A custom card block.'),
				'render_callback'	=> 'my_acf_block_render_callback',
				'category'				=> 'formatting',
				'icon'						=> 'admin-comments',
				'keywords'				=> array( 'custom', 'card' ),
			));

			// register a notifications block
			acf_register_block(array(
				'name'						=> 'notifications',
				'title'						=> __('Notifications'),
				'description'			=> __('A notifications block.'),
				'render_callback'	=> 'my_acf_block_render_callback',
				'category'				=> 'formatting',
				'icon'						=> 'admin-comments',
				'keywords'				=> array( 'notifications' ),
			));

			// register a recent posts block
			acf_register_block(array(
				'name'						=> 'recent-posts',
				'title'						=> __('Recent Posts'),
				'description'			=> __('Recent posts by category block.'),
				'render_callback'	=> 'my_acf_block_render_callback',
				'category'				=> 'formatting',
				'icon'						=> 'admin-comments',
				'keywords'				=> array( 'recent', 'posts', 'news' ),
			));

			// register a navigation block
			acf_register_block(array(
				'name'						=> 'navigation',
				'title'						=> __('Navigation'),
				'description'			=> __('A navigation block.'),
				'render_callback'	=> 'my_acf_block_render_callback',
				'category'				=> 'formatting',
				'icon'						=> 'admin-comments',
				'keywords'				=> array( 'navigation', 'menu', 'nav' ),
			));

		}
	}

	function my_acf_block_render_callback( $block ) {
		
		// convert name ("acf/testimonial") into path friendly slug ("testimonial")
		$slug = str_replace('acf/', '', $block['name']);
		
		// include a template part from within the "template-parts/block" folder
		if( file_exists(STYLESHEETPATH . "/block/block-{$slug}.php") ) {
			include( STYLESHEETPATH . "/block/block-{$slug}.php" );
		}
	}

	// Add support for page excerpts
	add_post_type_support( 'page', 'excerpt' );

	function sarnia_scripts() {
		wp_enqueue_style( 'sarnia-fonts', sarnia_theme_fonts_url() );
		wp_enqueue_style( 'sarnia-style', get_stylesheet_directory_uri() . '/assets/css/main.css', array(), filemtime( get_stylesheet_directory() . '/assets/css/main.css' ) );
		wp_enqueue_script( 'sarnia-global', get_stylesheet_directory_uri() . '/assets/js/global-min.js', array( 'jquery' ), filemtime( get_stylesheet_directory() . '/assets/js/global-min.js' ), true );

		// Move jQuery to footer
		if( ! is_admin() ) {
			wp_deregister_script( 'jquery' );
			wp_register_script( 'jquery', includes_url( '/js/jquery/jquery.js' ), false, NULL, true );
			wp_enqueue_script( 'jquery' );
		}
	}
	add_action( 'wp_enqueue_scripts', 'sarnia_scripts' );

	// Gutenberg scripts and styles
	function sarnia_gutenberg_scripts() {
		wp_enqueue_style( 'sarnia-fonts', sarnia_theme_fonts_url() );
		wp_enqueue_style( 'sarnia', get_stylesheet_directory_uri() . '/assets/css/admin-block-style.css', array(), filemtime( get_stylesheet_directory() . '/assets/css/admin-block-style.css' ) );
	}
	add_action( 'enqueue_block_editor_assets', 'sarnia_gutenberg_scripts' );

	if( function_exists('acf_add_local_field_group') ):

		acf_add_local_field_group(array(
			'key' => 'group_5c0956344ffff',
			'title' => 'Banner',
			'fields' => array(
				array(
					'key' => 'field_5c0d23865eabe',
					'label' => 'Byline',
					'name' => 'banner_byline',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
				array(
					'key' => 'field_5c095a8b398c9',
					'label' => 'Headline',
					'name' => 'banner_headline',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
				array(
					'key' => 'field_5c0d23915eabf',
					'label' => 'CTA Text',
					'name' => 'banner_cta_text',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
				array(
					'key' => 'field_5c0d23b25eac0',
					'label' => 'CTA URL',
					'name' => 'banner_cta_url',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
				array(
					'key' => 'field_5c0d329b138af',
					'label' => 'Image',
					'name' => 'banner_image',
					'type' => 'image',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'return_format' => 'array',
					'preview_size' => 'thumbnail',
					'library' => 'all',
					'min_width' => '',
					'min_height' => '',
					'min_size' => '',
					'max_width' => '',
					'max_height' => '',
					'max_size' => '',
					'mime_types' => '',
				),
			),
			'location' => array(
				array(
					array(
						'param' => 'block',
						'operator' => '==',
						'value' => 'acf/banner',
					),
				),
			),
			'menu_order' => 0,
			'position' => 'acf_after_title',
			'style' => 'seamless',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen' => '',
			'active' => 1,
			'description' => '',
		));
		
		acf_add_local_field_group(array(
			'key' => 'group_5c0984555b0da',
			'title' => 'Contact Information',
			'fields' => array(
				array(
					'key' => 'field_5c0989f3e37a1',
					'label' => 'Phone',
					'name' => 'phone',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
				array(
					'key' => 'field_5c098a03e37a2',
					'label' => 'Address',
					'name' => 'address',
					'type' => 'textarea',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'maxlength' => '',
					'rows' => '',
					'new_lines' => '',
				),
				array(
					'key' => 'field_5c0989dbe37a0',
					'label' => 'Hours',
					'name' => 'hours',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
				array(
					'key' => 'field_5c0989c6e379f',
					'label' => 'Email',
					'name' => 'email',
					'type' => 'email',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
				),
			),
			'location' => array(
				array(
					array(
						'param' => 'options_page',
						'operator' => '==',
						'value' => 'acf-options',
					),
				),
			),
			'menu_order' => 0,
			'position' => 'normal',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen' => '',
			'active' => 1,
			'description' => '',
		));
		
		acf_add_local_field_group(array(
			'key' => 'group_5c0d0c3ca4797',
			'title' => 'Custom Card',
			'fields' => array(
				array(
					'key' => 'field_5c0e5da5a5a59',
					'label' => 'Headline',
					'name' => 'custom_card_headline',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
				array(
					'key' => 'field_5c0e5db9a5a5a',
					'label' => 'Text',
					'name' => 'custom_card_text',
					'type' => 'textarea',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'maxlength' => '',
					'rows' => '',
					'new_lines' => '',
				),
				array(
					'key' => 'field_5c0e5df0a5a5c',
					'label' => 'CTA Text',
					'name' => 'custom_card_cta_text',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
				array(
					'key' => 'field_5c0e5dfaa5a5d',
					'label' => 'CTA URL',
					'name' => 'custom_card_cta_url',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
				array(
					'key' => 'field_5c0e5dd8a5a5b',
					'label' => 'Image',
					'name' => 'custom_card_image',
					'type' => 'image',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'return_format' => 'array',
					'preview_size' => 'thumbnail',
					'library' => 'all',
					'min_width' => '',
					'min_height' => '',
					'min_size' => '',
					'max_width' => '',
					'max_height' => '',
					'max_size' => '',
					'mime_types' => '',
				),
			),
			'location' => array(
				array(
					array(
						'param' => 'block',
						'operator' => '==',
						'value' => 'acf/custom-card',
					),
				),
			),
			'menu_order' => 0,
			'position' => 'normal',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen' => '',
			'active' => 1,
			'description' => '',
		));
		
		acf_add_local_field_group(array(
			'key' => 'group_5c0fcf1b317fe',
			'title' => 'Navigation',
			'fields' => array(
				array(
					'key' => 'field_5c0fcf29017dd',
					'label' => 'Menu',
					'name' => 'menu',
					'type' => 'nav_menu',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'save_format' => 'menu',
					'container' => 'div',
					'allow_null' => 1,
				),
			),
			'location' => array(
				array(
					array(
						'param' => 'block',
						'operator' => '==',
						'value' => 'acf/navigation',
					),
				),
			),
			'menu_order' => 0,
			'position' => 'normal',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen' => '',
			'active' => 1,
			'description' => '',
		));
		
		acf_add_local_field_group(array(
			'key' => 'group_5c0d6a74e7cbb',
			'title' => 'Notifications',
			'fields' => false,
			'location' => array(
				array(
					array(
						'param' => 'block',
						'operator' => '==',
						'value' => 'acf/notifications',
					),
					array(
						'param' => 'page_template',
						'operator' => '==',
						'value' => 'index.php',
					),
				),
			),
			'menu_order' => 0,
			'position' => 'normal',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen' => '',
			'active' => 1,
			'description' => '',
		));
		
		acf_add_local_field_group(array(
			'key' => 'group_5c0c5f4d4ac4e',
			'title' => 'Post Card',
			'fields' => array(
				array(
					'key' => 'field_5c0c602142663',
					'label' => 'Post',
					'name' => 'post_card',
					'type' => 'post_object',
					'instructions' => 'Select an existing post or page.',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'post_type' => array(
						0 => 'page',
						1 => 'post',
					),
					'taxonomy' => '',
					'allow_null' => 0,
					'multiple' => 0,
					'return_format' => 'object',
					'ui' => 1,
				),
			),
			'location' => array(
				array(
					array(
						'param' => 'block',
						'operator' => '==',
						'value' => 'acf/post-card',
					),
				),
			),
			'menu_order' => 0,
			'position' => 'normal',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen' => '',
			'active' => 1,
			'description' => '',
		));
		
		acf_add_local_field_group(array(
			'key' => 'group_5c0fcf62a7fa9',
			'title' => 'Recent Posts',
			'fields' => array(
				array(
					'key' => 'field_5c0fcf708cdcb',
					'label' => 'Recent Posts Category',
					'name' => 'recent_posts_category',
					'type' => 'taxonomy',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'taxonomy' => 'category',
					'field_type' => 'radio',
					'allow_null' => 0,
					'add_term' => 1,
					'save_terms' => 0,
					'load_terms' => 0,
					'return_format' => 'id',
					'multiple' => 0,
				),
			),
			'location' => array(
				array(
					array(
						'param' => 'block',
						'operator' => '==',
						'value' => 'acf/recent-posts',
					),
				),
			),
			'menu_order' => 0,
			'position' => 'normal',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen' => '',
			'active' => 1,
			'description' => '',
		));
		
		acf_add_local_field_group(array(
			'key' => 'group_5c098a33e1a52',
			'title' => 'Social',
			'fields' => array(
				array(
					'key' => 'field_5c098a3e1f946',
					'label' => 'Twitter',
					'name' => 'twitter',
					'type' => 'url',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
				),
				array(
					'key' => 'field_5c098a741f947',
					'label' => 'Facebook',
					'name' => 'facebook',
					'type' => 'url',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
				),
				array(
					'key' => 'field_5c098a821f948',
					'label' => 'Instagram',
					'name' => 'instagram',
					'type' => 'url',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
				),
			),
			'location' => array(
				array(
					array(
						'param' => 'options_page',
						'operator' => '==',
						'value' => 'acf-options',
					),
				),
			),
			'menu_order' => 0,
			'position' => 'normal',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen' => '',
			'active' => 1,
			'description' => '',
		));
		
		endif;
?>


