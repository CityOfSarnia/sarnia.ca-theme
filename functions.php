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
			'acf/notifications'
			//'core/video',
			//'core/embed',
			//'core-embed/youtube'
		);
	}

	// Edit the editor font sizes
	add_theme_support( 'editor-font-sizes', array(
		array(
			'name'      => __( 'regular', 'sarnia' ),
			'shortName' => __( 'M', 'sarnia' ),
			'size'      => 16,
			'slug'      => 'regular'
		)
	) );

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
			// acf_register_block(array(
			// 	'name'						=> 'recent-posts',
			// 	'title'						=> __('Recent Posts'),
			// 	'description'			=> __('Recent posts by category block.'),
			// 	'render_callback'	=> 'my_acf_block_render_callback',
			// 	'category'				=> 'formatting',
			// 	'icon'						=> 'admin-comments',
			// 	'keywords'				=> array( 'recent', 'posts', 'news' ),
			// ));

			// register a navigation block
			// acf_register_block(array(
			// 	'name'						=> 'navigation',
			// 	'title'						=> __('Navigation'),
			// 	'description'			=> __('A navigation block.'),
			// 	'render_callback'	=> 'my_acf_block_render_callback',
			// 	'category'				=> 'formatting',
			// 	'icon'						=> 'admin-comments',
			// 	'keywords'				=> array( 'navigation', 'menu', 'nav' ),
			// ));

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

	// Load admin block style
	function load_admin_block_style() {
		wp_register_style( 'admin_block_css', get_template_directory_uri() . '/assets/css/admin-block-style.css', false, '1.0.0' );
		wp_enqueue_style( 'admin_block_css' );
	}
	add_action( 'admin_enqueue_scripts', 'load_admin_block_style' );

	// Load block styles
	// wp_enqueue_style( 'block_css', get_template_directory_uri() . '/assets/css/block-style.css', false, '1.0.0' );


?>