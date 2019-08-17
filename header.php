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

    <?php if (is_search()) echo '<meta name="robots" content="noindex, nofollow" />'; ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="City of Sarnia">
    <meta name="Copyright" content="(C) 2019 City of Sarnia. All rights reserved.">

    <?php wp_enqueue_script("jquery"); ?>

    <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
    <div class="top">
<?php get_template_part('template-parts/header/header', 'notification'); ?>
<?php get_template_part('template-parts/header/header', 'nav'); ?>
    </div><!-- .top -->
    <div id="page" class="wrap">
<?php get_template_part('template-parts/header/header', 'header'); ?>
        <div class="banner"
            style="background-image: url(<?= get_field('header_image')['sizes']['home-banner']; ?>) !important;">

            <header class="banner__header">
                <?php if (!is_search()) { ?>
                <h1 class="<?= get_field('header_orientation') ? 'reverse' : ''; ?>">

                    <?php }
                    if (get_field('header_byline') && !is_search()) { ?>

                    <div class="banner__byline"><?php the_field('header_byline'); ?></div>

                    <?php }
                    if (is_search()) { ?>

                    <div class="banner__byline">Search Results for:</div>
                    <div class="banner__headline">&#8216;<?= get_query_var('s'); ?>&#8217; </div>

                    <?php } elseif (get_field('header_headline')) { ?>

                    <div class="banner__headline"><?php the_field('header_headline'); ?></div>

                    <?php } else { ?>

                    <?php if (is_category()) { ?>

                    <div class="banner__byline">Archive for Category:</div>
                    <div class="banner__headline">&#8216;<?= single_cat_title(); ?>&#8217;</div>

                    <?php } elseif (is_tag()) { ?>

                    <div class="banner__headline">Posts Tagged &#8216;<?= single_tag_title(); ?>&#8217;</div>

                    <?php } elseif (is_day()) { ?>

                    <div class="banner__headline">Archive for <?php the_time('F jS, Y'); ?></div>

                    <?php } elseif (is_month()) { ?>

                    <div class="banner__headline">Archive for <?php the_time('F, Y'); ?></div>

                    <?php } elseif (is_year()) { ?>

                    <div class="banner__headline">Archive for <?php the_time('Y'); ?></div>

                    <?php } elseif (is_404()) { ?>

                    <div class="banner__headline">404 Not Found</div>

                    <?php } else { ?>

                    <div class="banner__headline"><?php the_title(); ?></div>

                    <?php } ?>

                    <?php } ?>

                </h1>

                <?php if (get_field('header_cta_url') && !is_search()) { ?>

                <a href="<?php the_field('header_cta_url'); ?>"
                    class="btn banner__cta"><?php the_field('header_cta_text'); ?></a>

                <?php } ?>

            </header>

        </div>


        <main role="main">