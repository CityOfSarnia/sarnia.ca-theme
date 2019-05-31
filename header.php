<!doctype html>

<!--[if lt IE 7 ]> <html class="ie ie6 ie-lt10 ie-lt9 ie-lt8 ie-lt7 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 ie-lt10 ie-lt9 ie-lt8 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 ie-lt10 ie-lt9 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 ie-lt10 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!--><html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->
<!-- the "no-js" class is for Modernizr. --> 

<head>
<!-- Global Site Tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=<?=getenv('google.analytics.trackingID')?>"></script>
<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());

	gtag('config', '<?=getenv('google.analytics.trackingID')?>');
</script>

	<meta charset="<?php bloginfo('charset'); ?>">

	<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />
    
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<?php if (is_search()) { ?>
		<meta name="robots" content="noindex, nofollow" /> 
	<?php } ?>

	<title><?php wp_title(''); ?></title>
	
	<meta name="author" content="Screenthink">
	
	<meta name="Copyright" content="Screenthink All Rights Reserved.">
	
	<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/_/img/favicon.ico">
	
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
	
	<?php wp_enqueue_script("jquery"); ?>
	
	<?php wp_head(); ?>
		
</head>

<body <?php body_class(); ?>>

	<?php $loop = new WP_Query( array( 'post_type' => 'notifications', 'filter' => 'feature', 'posts_per_page' => 1 ) ); ?>        
	<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
		<?php
			$terms = get_the_terms( $post->ID, 'notification-icon' );
			if ($terms) {
				$terms_slugs = array();
				foreach ( $terms as $term ) {
						$terms_slugs[] = $term->slug;
				}
				$icon = $terms_slugs[0];
			} else {
				$icon = 'default-notification';
			}
		?>
		<div class="feature-notification">
			<div class="container feature-notification__wrapper">
				<div class="feature-notification__icon"><?php include(TEMPLATEPATH . '/assets/img/icons/' . $icon . '.svg'); ?></div>
				<div class="feature-notification__main">
					<h4 class="feature-notification__headline"><?php the_title(); ?></h4>
					<p class="feature-notification__text"><?php echo get_the_content(); ?></p>
				</div>
			</div>
		</div>
	<?php endwhile; ?>			
	<?php wp_reset_query(); ?>
 
	<header class="header" role="banner">
		<div class="header__wrapper">
			<a href="/" class="logo">City of Sarnia</a>
			<nav class="primary-menu" role="navigation">
				<?php wp_nav_menu( array(
					'theme_location' => 'primary-menu',
					'container_class' => 'primary-menu__container',
					'walker' => new Add_button_of_Sublevel_Walker
				)); ?>
			</nav>
			<div class="search-form">
				<script>
					(function() {
						var cx = '<?=getenv('google.cse.cx')?>';
						var gcse = document.createElement('script');
						gcse.type = 'text/javascript';
						gcse.async = true;
						gcse.src = 'https://cse.google.com/cse.js?cx=' + cx;
						var s = document.getElementsByTagName('script')[0];
						s.parentNode.insertBefore(gcse, s);
					})();
				</script>
				<gcse:searchbox-only resultsUrl="/search"></gcse:searchbox-only>
			</div>
		</div>
	</header>
	
	<main role="main">