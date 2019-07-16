<?php

	use function \Sober\Intervention\intervention;

	if (function_exists('\Sober\Intervention\intervention')) {
		// now you can use the function to call the required modules and their params
		intervention('remove-menu-items', 'plugins', ['editor', 'author']);
		//intervention('remove-menu-items', 'plugins', 'all');
		intervention('remove-emoji');
		// Removes howdy and replaces with Hello.
		intervention('remove-howdy', 'Hello');
	}

	function card_colour()
	{
		global $card_count;

		$card_count++;

		switch($card_count){
			case 1 :
				$colour = 'card--blue';
				break;
			case 2 :
				$colour = 'card--red';
				break;
			case 3 :
				$colour = 'card--yellow';
				$card_count = 0;
				break;
			default :
				$card_count = 0;
		}

		return $colour;
	}

	// Custom Except Length
	function sarnia_excerpt_length( $length ) {
		return 20;
	}
	add_filter( 'excerpt_length', 'sarnia_excerpt_length' );

	// Define Post Thumbnails
	add_theme_support( 'post-thumbnails');
	add_image_size( 'home-banner', 1000, 900, true );
	add_image_size( 'banner', 1600, 600, true );
	add_image_size( 'card', 780, 200, true );

	// Add Theme Features
	add_post_type_support( 'page', 'excerpt' );

	// Register Main Menu
	add_action( 'init', 'register_my_menu' );

	function register_my_menu() {
		register_nav_menu( 'primary-menu', __( 'Primary Menu' ) );
		register_nav_menu( 'footer-menu', __( 'Footer Menu' ) );
	}

	// Add toggle button when 2nd level navigation exists
	class Add_button_of_Sublevel_Walker extends Walker_Nav_Menu
	{
		function start_lvl( &$output, $depth = 0, $args = array() ) {
			$indent = str_repeat("\t", $depth);
			$output .= "\n$indent<button type='button' class='toggle-sub-menu'>
			</button><ul class='sub-menu'>\n";
		}
		function end_lvl( &$output, $depth = 0, $args = array() ) {
			$indent = str_repeat("\t", $depth);
			$output .= "$indent</ul>\n";
		}
	}

	function create_my_post_types() {
		register_post_type( 'notifications',
				array(
						'labels' => array(
						'name' => __( 'Notifications' ),
						'singular_name' => __( 'Notification' )
						),
						'public' => true,
						'menu_icon' => 'dashicons-star-filled',
						'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
			'exclude_from_search' => true,
			'show_in_admin_bar'   => false,
			'show_in_nav_menus'   => false,
			'publicly_queryable'  => false,
			'query_var'           => false,
				)
		);
	}

	add_action( 'init', 'create_my_post_types' );

	// Create Custom Taxonomies
	add_action( 'init', 'build_taxonomies', 0 );

	function build_taxonomies() {

		register_taxonomy(
			'filter',
			array('notifications'),
			array(
				'hierarchical' => true,
				'label' => 'Filter',
				'query_var' => true,
			)
		);

		register_taxonomy(
			'notification-icon',
			array('notifications'),
			array(
				'hierarchical' => true,
				'label' => 'Notification Icon',
				'query_var' => true,
			)
		);
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
		add_theme_support( 'automatic-feed-links' );
		add_filter( 'feed_links_show_comments_feed', '__return_false' );
		remove_filter( 'the_content', 'wpautop' );
	}
	add_action( 'after_setup_theme', 'sarnia_setup' );

	// Limit the core blocks
	add_filter( 'allowed_block_types', 'sarnia_allowed_block_types' );
	function sarnia_allowed_block_types( $allowed_blocks ) {
		return array(
			'core/image',
			'core/paragraph',
			'core/heading',
			'core/gallery',
			'core/table',
			'core/list',
			'core/columns',
			'core/file',
			'core/html',
			'acf/post-card',
			'acf/custom-card',
//			'acf/banner',
			'acf/notifications',
			'acf/navigation',
			'acf/recent-posts',
			'core/video',
			'core-embed/youtube',
			'core-embed/vimeo',
			'core-embed/facebook',
			'core-embed/twitter',
//			'gravityforms/block',
			'gravityforms/form',
			'luckywp/tableofcontents'
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
				'icon'						=> 'id',
				'keywords'				=> array( 'banner', 'menu', 'nav' ),
				'supports' 				=> array( 'align' => array( 'full' ) ),
			));

			// register a post card block
			acf_register_block(array(
				'name'						=> 'post-card',
				'title'						=> __('Post Card'),
				'description'			=> __('A post or page card block.'),
				'render_callback'	=> 'my_acf_block_render_callback',
				'category'				=> 'formatting',
				'icon'						=> 'media-default',
				'keywords'				=> array( 'post', 'card' ),
				'supports' 				=> array( 'align' => false ),
			));

			// register a custom card block
			acf_register_block(array(
				'name'						=> 'custom-card',
				'title'						=> __('Custom Card'),
				'description'			=> __('A custom card block.'),
				'render_callback'	=> 'my_acf_block_render_callback',
				'category'				=> 'formatting',
				'icon'						=> 'media-text',
				'keywords'				=> array( 'custom', 'card' ),
				'supports' 				=> array( 'align' => false ),
			));

			// register a notifications block
			acf_register_block(array(
				'name'						=> 'notifications',
				'title'						=> __('Notifications'),
				'description'			=> __('A notifications block.'),
				'render_callback'	=> 'my_acf_block_render_callback',
				'category'				=> 'formatting',
				'icon'						=> 'star-filled',
				'keywords'				=> array( 'notifications' ),
				'supports' 				=> array( 'align' => array( 'full' ) ),
			));

			// register a recent posts block
			acf_register_block(array(
				'name'						=> 'recent-posts',
				'title'						=> __('Recent Posts'),
				'description'			=> __('Recent posts by category block.'),
				'render_callback'	=> 'my_acf_block_render_callback',
				'category'				=> 'formatting',
				'icon'						=> 'admin-page',
				'keywords'				=> array( 'recent', 'posts', 'news' ),
				'supports' 				=> array( 'align' => array( 'wide' ) ),
			));

			// register a navigation block
			acf_register_block(array(
				'name'						=> 'navigation',
				'title'						=> __('Navigation'),
				'description'			=> __('A navigation block.'),
				'render_callback'	=> 'my_acf_block_render_callback',
				'category'				=> 'formatting',
				'icon'						=> 'list-view',
				'keywords'				=> array( 'navigation', 'menu', 'nav' ),
				'supports' 				=> array( 'align' => false ),
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

		// for search
		wp_enqueue_script( 'jquery-ui-autocomplete' );
		wp_register_style( 'jquery-ui-styles','//ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css' );
		wp_enqueue_style( 'jquery-ui-styles' );
		wp_register_script( 'sarnia-search-autocomplete', get_template_directory_uri() . '/assets/js/search-autocomplete.js', array( 'jquery', 'jquery-ui-autocomplete' ), '1.0', false );
		wp_localize_script( 'sarnia-search-autocomplete', 'SarniaSearchAutocomplete', array( 'url' => admin_url( 'admin-ajax.php' ) ) );
		wp_enqueue_script( 'sarnia-search-autocomplete' );
	}
	add_action( 'wp_enqueue_scripts', 'sarnia_scripts' );

	// Gutenberg scripts and styles
	function sarnia_gutenberg_scripts() {
		wp_enqueue_style( 'sarnia-fonts', sarnia_theme_fonts_url() );
		wp_enqueue_style( 'sarnia', get_stylesheet_directory_uri() . '/assets/css/admin-block-style.css', array(), filemtime( get_stylesheet_directory() . '/assets/css/admin-block-style.css' ) );
		wp_enqueue_script( 'sarnia', get_stylesheet_directory_uri() . '/assets/js/admin-block.js', array( 'jquery' ), filemtime( get_stylesheet_directory() . '/assets/js/admin-block.js' ), true );
	}
	add_action( 'enqueue_block_editor_assets', 'sarnia_gutenberg_scripts' );

	if( function_exists('acf_add_local_field_group') ):

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
					'type' => 'wysiwyg',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'tabs' => 'all',
					'toolbar' => 'basic',
					'media_upload' => 0,
					'delay' => 0,
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
				array(
					'key' => 'field_5c840c0e9ca96',
					'label' => 'Image Size',
					'name' => 'custom_card_image_size',
					'type' => 'checkbox',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'choices' => array(
						'Portrait' => 'Portrait',
					),
					'allow_custom' => 0,
					'default_value' => array(
					),
					'layout' => 'vertical',
					'toggle' => 0,
					'return_format' => 'value',
					'save_custom' => 0,
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
			'key' => 'group_5c0956344ffff',
			'title' => 'Header',
			'fields' => array(
				array(
					'key' => 'field_5c095a8b398c9',
					'label' => 'Headline',
					'name' => 'header_headline',
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
					'key' => 'field_5c0d23865eabe',
					'label' => 'Byline',
					'name' => 'header_byline',
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
					'key' => 'field_5cf15cd71a963',
					'label' => 'Header Orientation',
					'name' => 'header_orientation',
					'type' => 'true_false',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'message' => 'Reverse',
					'default_value' => 0,
					'ui' => 0,
					'ui_on_text' => '',
					'ui_off_text' => '',
				),
				array(
					'key' => 'field_5c0d23915eabf',
					'label' => 'CTA Text',
					'name' => 'header_cta_text',
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
					'name' => 'header_cta_url',
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
					'name' => 'header_image',
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
						'param' => 'post_type',
						'operator' => '==',
						'value' => 'page',
					),
				),
				array(
					array(
						'param' => 'post_type',
						'operator' => '==',
						'value' => 'post',
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
					'save_format' => 'id',
					'container' => 'div',
					'allow_null' => 1,
				),
				array(
					'key' => 'field_5c1713f0b2167',
					'label' => 'Menu Headline',
					'name' => 'menu_headline',
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
					'key' => 'field_5c171407b2168',
					'label' => 'Menu Image',
					'name' => 'menu_image',
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
			'key' => 'group_5c1adbf094daa',
			'title' => 'Notification Details',
			'fields' => array(
				array(
					'key' => 'field_5c1adbfa22e61',
					'label' => 'Notification Date',
					'name' => 'notification_date',
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
			),
			'location' => array(
				array(
					array(
						'param' => 'post_type',
						'operator' => '==',
						'value' => 'notifications',
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
				array(
					'key' => 'field_5d1cc1d0380bb',
					'label' => 'Recent Posts Count',
					'name' => 'recent_posts_count',
					'type' => 'range',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'min' => 3,
					'max' => 6,
					'step' => '',
					'prepend' => '',
					'append' => '',
				),
				array(
					'key' => 'field_5c16f929e1ffd',
					'label' => 'Recent Posts Headline',
					'name' => 'recent_posts_headline',
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
					'key' => 'field_5c16f9581f897',
					'label' => 'Recent Posts Image',
					'name' => 'recent_posts_image',
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

        // Widgets
        if ( function_exists('register_sidebar' )) {
                function sarnia_widgets_init() {
                        register_sidebar( array(
                                'name' => __( 'Sidebar Widgets', 'sarnia' ),
                                'id' => 'sidebar-primary',
                                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                                'after_widget'  => '</div>',
                                'before_title'  => '<h3 class="widget-title">',
                                'after_title'   => '</h3>',
                        ) );
                }
                add_action( 'widgets_init', 'sarnia_widgets_init' );
        }

/**
 * Enable features from Soil when plugin is activated
 * @link https://roots.io/plugins/soil/
 */
add_theme_support('soil-clean-up');
//add_theme_support('soil-disable-rest-api');
add_theme_support('soil-disable-asset-versioning');
add_theme_support('soil-disable-trackbacks');
//add_theme_support('soil-js-to-footer');
add_theme_support('soil-nav-walker');
add_theme_support('soil-nice-search');
add_theme_support('soil-relative-urls');

/*
 * Let WordPress manage the document title.
 * By adding theme support, we declare that this theme does not use a
 * hard-coded <title> tag in the document head, and expect WordPress to
 * provide it for us.
 */
add_theme_support( 'title-tag' );

function my_acf_post_id() {
	if ( is_admin() && function_exists( 'acf_maybe_get_POST' ) ) :
		return intval( acf_maybe_get_POST( 'post_id' ) );
	else :
		global $post;
		return $post->ID;
	endif;
}

/* search functions */
function sarnia_highlight_results($text){
	if(is_search()){
		$search = get_query_var('s');
		$text = preg_replace('/('. $search .')/iu', '<span class="search-result__highlight">$1</span>', $text);
	}

	return $text;
}
add_filter('the_excerpt', 'sarnia_highlight_results');
add_filter('the_title', 'sarnia_highlight_results');

function sarnia_auto_search() {
	$term = strtolower( $_GET['term'] );
	$suggestions = array();
	$loop = new WP_Query( 's=' . $term );
	
	while( $loop->have_posts() ) {
		$loop->the_post();
		$suggestion = array();
		$suggestion['label'] = get_the_title();
		$suggestion['link'] = get_permalink();
		
		$suggestions[] = $suggestion;
	}
	wp_reset_query();
		
	$response = json_encode( $suggestions );
	echo $response;
	exit();
}
add_action('wp_ajax_auto_search', 'sarnia_auto_search');
add_action('wp_ajax_nopriv_auto_search', 'sarnia_auto_search');