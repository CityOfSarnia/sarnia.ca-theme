<!doctype html>

<!--[if lt IE 7 ]> <html class="ie ie6 ie-lt10 ie-lt9 ie-lt8 ie-lt7 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 ie-lt10 ie-lt9 ie-lt8 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 ie-lt10 ie-lt9 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 ie-lt10 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!--><html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->
<!-- the "no-js" class is for Modernizr. --> 

<head>
<!-- Global Site Tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=GA_TRACKING_ID"></script>
<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());

	gtag('config', 'GA_TRACKING_ID');
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
		<div class="feature-notification">
			<div class="container">
				<div class="feature-notification__headline"><?php the_title(); ?></div>
				<div class="feature-notification__text"><?php the_content(); ?></div>
			</div>
		</div>
	<?php endwhile; ?>			
	<?php wp_reset_query(); ?>
 
	<header class="header" role="banner">
		<div class="header__wrapper">
			<a href="/" class="logo">City of Sarnia</a>
			<div class="search-form"></div>
		</div>
	</header>
	
	<main role="main">