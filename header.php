<!doctype html>

<!--[if lt IE 7 ]> <html class="ie ie6 ie-lt10 ie-lt9 ie-lt8 ie-lt7 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 ie-lt10 ie-lt9 ie-lt8 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 ie-lt10 ie-lt9 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 ie-lt10 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!--><html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->
<!-- the "no-js" class is for Modernizr. --> 

<head>

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
	
	<!-- Google Analytics -->
	<script type="text/javascript">

	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', '']);
	  _gaq.push(['_trackPageview']);
	
	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();
	
	</script>
		
</head>

<body <?php body_class(); ?>>

	<div class="feature-notification">
		<div class="container">
			<div class="feature-notification__headline">Road Closure</div>
			<div class="feature-notification__text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit iste ea reiciendis quam minima error necessitatibus optio Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</div>
		</div>
	</div>
 
	<header class="header" role="banner">
		<div class="header__wrapper">
			<a href="/" class="logo">City of Sarnia</a>
			<div class="search-form"></div>
		</div>
	</header>
	
	<main role="main">