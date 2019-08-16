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
        <?php $loop = new WP_Query(array('post_type' => 'notifications', 'filter' => 'feature', 'posts_per_page' => 1)); ?>
        <?php while ($loop->have_posts()) : $loop->the_post(); ?>
        <?php
            $terms = get_the_terms($post->ID, 'notification-icon');
            if ($terms) {
                $terms_slugs = array();
                foreach ($terms as $term) {
                    $terms_slugs[] = $term->slug;
                }
                $icon = $terms_slugs[0];
            } else {
                $icon = 'default-notification';
            }
            ?>
        <div class="feature-notification">
            <div class="container feature-notification__wrapper">
                <div class="feature-notification__icon">
                    <?php get_template_part('/assets/img/icons/inline', $icon . '.svg'); ?></div>
                <div class="feature-notification__main">
                    <h4 class="feature-notification__headline"><?php the_title(); ?></h4>
                    <p class="feature-notification__text"><?= get_the_content(); ?></p>
                </div>
            </div>
        </div>

        <?php endwhile; ?>
        <?php wp_reset_query(); ?>

        <nav class="primary-menu" role="navigation">
            <?php wp_nav_menu(array(
                'theme_location' => 'primary-menu',
                'container_class' => 'primary-menu__container',
                'walker' => new Add_button_of_Sublevel_Walker
            )); ?>
        </nav>
    </div>

    <div id="page" class="wrap">

        <header class="header" role="banner">
            <div class="header__wrapper">
                <button class="primary-menu__toggle js-primary-menu__toggle">Toggle Menu</button>
                <a href="/" class="logo">City of Sarnia</a>
                <div class="search-form">
                    <?php get_search_form() ?>
                </div>
            </div>
        </header>

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