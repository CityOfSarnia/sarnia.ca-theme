<!doctype html>

<!--[if lt IE 7 ]> <html class="ie ie6 ie-lt10 ie-lt9 ie-lt8 ie-lt7 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 ie-lt10 ie-lt9 ie-lt8 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 ie-lt10 ie-lt9 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 ie-lt10 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]>  <html class="no-js" <?php language_attributes(); ?>> <![endif]-->

<!-- the "no-js" class is for Modernizr. -->

<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="City of Sarnia">
        <meta name="Copyright" content="(C) 2019 City of Sarnia. All rights reserved.">
<?php if (is_search()) : ?>
        <meta name="robots" content="noindex, nofollow" />
<?php endif; ?>
<?php wp_enqueue_script("jquery"); ?>
<?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <div class="top">
<?php get_template_part('template-parts/header/notification'); ?>
<?php get_template_part('template-parts/header/navigation'); ?>
        </div><!-- .top -->
        <div id="page" class="wrap">
<?php get_template_part('template-parts/header/header'); ?>
<?php get_template_part('template-parts/header/banner'); ?>
            <main role="main">
