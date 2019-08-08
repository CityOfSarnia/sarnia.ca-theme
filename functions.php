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

	switch ($card_count) {
		case 1:
			$colour = 'card--blue';
			break;
		case 2:
			$colour = 'card--red';
			break;
		case 3:
			$colour = 'card--yellow';
			$card_count = 0;
			break;
		default:
			$card_count = 0;
	}

	return $colour;
}

// Custom Except Length
function sarnia_excerpt_length($length)
{
	return 20;
}
add_filter('excerpt_length', 'sarnia_excerpt_length');

// Define Post Thumbnails
add_theme_support('post-thumbnails');
add_image_size('home-banner', 1000, 900, true);
add_image_size('banner', 1600, 600, true);
add_image_size('card', 780, 200, true);

// Add Theme Features
add_post_type_support('page', 'excerpt');

// Register Main Menu
add_action('init', 'register_my_menu');

function register_my_menu()
{
	register_nav_menu('primary-menu', __('Primary Menu'));
	register_nav_menu('footer-menu', __('Footer Menu'));
}

// Add toggle button when 2nd level navigation exists
class Add_button_of_Sublevel_Walker extends Walker_Nav_Menu
{
	function start_lvl(&$output, $depth = 0, $args = array())
	{
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<button type='button' class='toggle-sub-menu'>
			</button><ul class='sub-menu'>\n";
	}
	function end_lvl(&$output, $depth = 0, $args = array())
	{
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul>\n";
	}
}

function create_my_post_types()
{
	register_post_type(
		'notifications',
		array(
			'labels' => array(
				'name' => __('Notifications'),
				'singular_name' => __('Notification')
			),
			'public' => true,
			'menu_icon' => 'dashicons-star-filled',
			'supports' => array('title', 'editor', 'excerpt', 'thumbnail'),
			'exclude_from_search' => true,
			'show_in_admin_bar'   => false,
			'show_in_nav_menus'   => false,
			'publicly_queryable'  => false,
			'query_var'           => false,
		)
	);
}

add_action('init', 'create_my_post_types');

// Numbered Pagination
function sarnia_number_pagination()
{
	global $wp_query;
	$big = 9999999;
	echo "<div class='pagination'>";
	echo paginate_links(array(
		'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
		'format' => '?paged=%#%',
		'prev_text' => __('Previous'),
		'next_text' => __('Next'),
		'current' => max(1, get_query_var('paged')),
		'total' => $wp_query->max_num_pages
	));
	echo "</div>";
}

// Create Custom Taxonomies
add_action('init', 'build_taxonomies', 0);

function build_taxonomies()
{

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
if (function_exists('acf_add_options_page')) {
	acf_add_options_page();
}

// Add theme support for wide content alignment
function sarnia_setup()
{
	add_theme_support('align-wide');
	add_theme_support('editor-color-palette');
	add_theme_support('disable-custom-colors');
	add_theme_support('disable-custom-font-sizes');
	add_theme_support('responsive-embeds');
	add_theme_support('automatic-feed-links');
	add_filter('feed_links_show_comments_feed', '__return_false');
	remove_filter('the_content', 'wpautop');
}
add_action('after_setup_theme', 'sarnia_setup');

// Limit the core blocks
add_filter('allowed_block_types', 'sarnia_allowed_block_types');
function sarnia_allowed_block_types($allowed_blocks)
{
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
		'acf/accordion',
		'acf/post-card',
		'acf/custom-card',
		'acf/notifications',
		'acf/navigation',
		'acf/recent-posts',
		'core/video',
		'core-embed/youtube',
		'core-embed/vimeo',
		'core-embed/facebook',
		'core-embed/twitter',
		'gravityforms/form',
		'luckywp/tableofcontents'
	);
}

// Edit the editor font sizes
add_theme_support('editor-font-sizes', array(
	array(
		'name'      => __('small', 'sarnia'),
		'shortName' => __('S', 'sarnia'),
		'size'      => 14,
		'slug'      => 'small'
	),
	array(
		'name'      => __('regular', 'sarnia'),
		'shortName' => __('M', 'sarnia'),
		'size'      => 16,
		'slug'      => 'regular'
	),
	array(
		'name'      => __('large', 'sarnia'),
		'shortName' => __('L', 'sarnia'),
		'size'      => 20,
		'slug'      => 'large'
	)
));

// Theme Fonts URL
function sarnia_theme_fonts_url()
{
	$font_families = apply_filters('sarnia_theme_fonts', array('Open+Sans:300,300i,400,600|Playfair+Display'));
	$query_args = array(
		'family' => implode('|', $font_families),
		'subset' => 'latin,latin-ext',
	);
	$fonts_url = add_query_arg($query_args, 'https://fonts.googleapis.com/css');
	return esc_url_raw($fonts_url);
}

add_action('acf/init', 'my_acf_init');
function my_acf_init()
{

	// check function exists
	if (function_exists('acf_register_block')) {

		// register a banner block
		acf_register_block(array(
			'name'						=> 'banner',
			'title'						=> __('Banner'),
			'description'			=> __('A banner block.'),
			'render_callback'	=> 'my_acf_block_render_callback',
			'category'				=> 'formatting',
			'icon'						=> 'id',
			'keywords'				=> array('banner', 'menu', 'nav'),
			'supports' 				=> array('align' => array('full')),
		));

		// register a post card block
		acf_register_block(array(
			'name'						=> 'post-card',
			'title'						=> __('Post Card'),
			'description'			=> __('A post or page card block.'),
			'render_callback'	=> 'my_acf_block_render_callback',
			'category'				=> 'formatting',
			'icon'						=> 'media-default',
			'keywords'				=> array('post', 'card'),
			'supports' 				=> array('align' => false),
		));

		// register a custom card block
		acf_register_block(array(
			'name'						=> 'custom-card',
			'title'						=> __('Custom Card'),
			'description'			=> __('A custom card block.'),
			'render_callback'	=> 'my_acf_block_render_callback',
			'category'				=> 'formatting',
			'icon'						=> 'media-text',
			'keywords'				=> array('custom', 'card'),
			'supports' 				=> array('align' => false),
		));

		// register an accordion block
		acf_register_block(array(
			'name'						=> 'accordion',
			'title'						=> __('Accordion'),
			'description'			=> __('An accordion block.'),
			'render_callback'	=> 'my_acf_block_render_callback',
			'category'				=> 'formatting',
			'icon'						=> 'plus',
			'keywords'				=> array('accordion', 'toggle', 'dropdown'),
			'supports' 				=> array('align' => false),
		));

		// register a notifications block
		acf_register_block(array(
			'name'						=> 'notifications',
			'title'						=> __('Notifications'),
			'description'			=> __('A notifications block.'),
			'render_callback'	=> 'my_acf_block_render_callback',
			'category'				=> 'formatting',
			'icon'						=> 'star-filled',
			'keywords'				=> array('notifications'),
			'supports' 				=> array('align' => array('full')),
		));

		// register a recent posts block
		acf_register_block(array(
			'name'						=> 'recent-posts',
			'title'						=> __('Recent Posts'),
			'description'			=> __('Recent posts by category block.'),
			'render_callback'	=> 'my_acf_block_render_callback',
			'category'				=> 'formatting',
			'icon'						=> 'admin-page',
			'keywords'				=> array('recent', 'posts', 'news'),
			'supports' 				=> array('align' => array('wide')),
		));

		// register a navigation block
		acf_register_block(array(
			'name'						=> 'navigation',
			'title'						=> __('Navigation'),
			'description'			=> __('A navigation block.'),
			'render_callback'	=> 'my_acf_block_render_callback',
			'category'				=> 'formatting',
			'icon'						=> 'list-view',
			'keywords'				=> array('navigation', 'menu', 'nav'),
			'supports' 				=> array('align' => false),
		));
	}
}

function my_acf_block_render_callback($block)
{

	// convert name ("acf/testimonial") into path friendly slug ("testimonial")
	$slug = str_replace('acf/', '', $block['name']);

	// include a template part from within the "template-parts/block" folder
	if (file_exists(STYLESHEETPATH . "/block/block-{$slug}.php")) {
		include(STYLESHEETPATH . "/block/block-{$slug}.php");
	}
}

// Add support for page excerpts
add_post_type_support('page', 'excerpt');

function sarnia_scripts()
{
	wp_enqueue_style('sarnia-fonts', sarnia_theme_fonts_url());
	wp_enqueue_script('jquery-ui-autocomplete');
	wp_enqueue_style('jquery-ui-styles', '//ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css');

	$is_hot = (WP_ENV == 'local');
	if ($is_hot) {
		if (getenv('DEVSERVER_IGNORE_SSL_ERRORS')) {
			// this ignores SSL errors, only use in dev, here be dragons!
			$context_options = array(
				"ssl" => array(
					"verify_peer" => false,
					"verify_peer_name" => false,
				),
			);
		} else {
			$context_options = array();
		}
		$manifest_json = file_get_contents(getenv('DEVSERVER_PUBLIC') . '/manifest.json', false, stream_context_create($context_options));
		$manifest = json_decode($manifest_json, true);

		// css is loaded via js
		wp_register_script('sarnia-js', $manifest['app.js'], array('jquery', 'jquery-ui-autocomplete'), $manifest['app.js'], true);
	} else {
		$manifest = json_decode(file_get_contents(get_stylesheet_directory() . '/assets/dist/manifest.json'), true);
		$legacy_manifest = json_decode(file_get_contents(get_stylesheet_directory() . '/assets/dist/manifest-legacy.json'), true);

		wp_enqueue_style('sarnia-style', WP_HOME . $legacy_manifest['app.css'], array(), $legacy_manifest['app.css']);
		wp_register_script('sarnia-js', WP_HOME . $manifest['app.js'], array('jquery', 'jquery-ui-autocomplete'), $manifest['app.js'], true);
	}

	wp_localize_script('sarnia-js', 'SarniaSearchAutocomplete', array('url' => admin_url('admin-ajax.php')));
	wp_enqueue_script('sarnia-js');

	// Move jQuery to footer
	if (!is_admin()) {
		wp_deregister_script('jquery');
		wp_register_script('jquery', includes_url('/js/jquery/jquery.js'), false, NULL, true);
		wp_enqueue_script('jquery');
	}
}
add_action('wp_enqueue_scripts', 'sarnia_scripts');

// Gutenberg scripts and styles
function sarnia_gutenberg_scripts()
{
	wp_enqueue_style('sarnia-fonts', sarnia_theme_fonts_url());
	wp_enqueue_style('sarnia', get_stylesheet_directory_uri() . '/assets/css/admin-block-style.css', array(), filemtime(get_stylesheet_directory() . '/assets/css/admin-block-style.css'));
	wp_enqueue_script('sarnia', get_stylesheet_directory_uri() . '/assets/js/admin-block.js', array('jquery'), filemtime(get_stylesheet_directory() . '/assets/js/admin-block.js'), true);
}
add_action('enqueue_block_editor_assets', 'sarnia_gutenberg_scripts');

function my_acf_json_load_point($paths)
{
	// remove original path (optional)
	unset($paths[0]);
	$paths[] = get_stylesheet_directory() . '/assets/acf-json';

	return   $paths;
}
add_filter('acf/settings/load_json', 'my_acf_json_load_point');

function my_acf_json_save_point($path)
{
	// update path
	$path = get_stylesheet_directory() . '/assets/acf-json';

	// return
	return $path;
}
add_filter('acf/settings/save_json', 'my_acf_json_save_point');

// Widgets
if (function_exists('register_sidebar')) {
	function sarnia_widgets_init()
	{
		register_sidebar(array(
			'name' => __('Sidebar Widgets', 'sarnia'),
			'id' => 'sidebar-primary',
			'before_widget' => '<div id="%1  $s" class="widget %2  $s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		));
	}
	add_action('widgets_init', 'sarnia_widgets_init');
}

/**
 * Enable features from Soil when plugin is activated
 * @link https://roots.io/plugins/soil/
 */
add_theme_support('soil-clean-up');
add_theme_support('soil-disable-asset-versioning');
add_theme_support('soil-disable-trackbacks');
add_theme_support('soil-google-analytics', env('GOOGLE_ANALYTICS_TRACKINGID'));
add_theme_support('soil-js-to-footer');
add_theme_support('soil-nav-walker');
add_theme_support('soil-nice-search');
add_theme_support('soil-relative-urls');

/*
 * Let WordPress manage the document title.
 * By adding theme support, we declare that this theme does not use a
 * hard-coded <title> tag in the document head, and expect WordPress to
 * provide it for us.
 */
add_theme_support('title-tag');

function my_acf_post_id()
{
	if (is_admin() && function_exists('acf_maybe_get_POST')) :
		return intval(acf_maybe_get_POST('post_id'));
	else :
		global   $post;
		return   $post->ID;
	endif;
}

/* search functions */
function sarnia_highlight_results($text)
{
	if (in_the_loop() && is_search()) {
		$search = preg_quote(get_query_var('s'));
		$text = preg_replace('/(' .   $search . ')/iu', '<span class="search-result__highlight">$1</span>',   $text);
	}

	return   $text;
}
add_filter('the_excerpt', 'sarnia_highlight_results');
add_filter('the_title', 'sarnia_highlight_results');

function sarnia_auto_search()
{
	$term = strtolower($_GET['term']);
	$suggestions = array();
	$loop = new WP_Query('s=' .   $term);

	while ($loop->have_posts()) {
		$loop->the_post();
		$suggestion = array();
		$suggestion['label'] = get_the_title();
		$suggestion['link'] = get_permalink();

		$suggestions[] =   $suggestion;
	}
	wp_reset_query();

	$response = json_encode($suggestions);
	echo   $response;
	exit();
}
add_action('wp_ajax_auto_search', 'sarnia_auto_search');
add_action('wp_ajax_nopriv_auto_search', 'sarnia_auto_search');
