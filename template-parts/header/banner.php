<div class="banner"
    style="background-image: url(<?=get_field('header_image')['sizes']['home-banner'];?>) !important;">

    <header class="banner__header">
<?php if (!is_search()) :?>
        <h1 class="<?=get_field('header_orientation') ? 'reverse' : '';?>">
<?php endif; ?>
<?php if (get_field('header_byline') && !is_search()) :?>
        <div class="banner__byline"><?php the_field('header_byline');?></div>
<?php endif; ?>
<?php if (is_search()) :?>
        <div class="banner__byline">Search Results for:</div>
        <div class="banner__headline">&#8216;<?=get_query_var('s');?>&#8217; </div>
<?php elseif (get_field('header_headline')) :?>
        <div class="banner__headline"><?php the_field('header_headline');?></div>
<?php else: ?>
<?php if (is_category()) :?>
        <div class="banner__byline">Archive for Category:</div>
        <div class="banner__headline">&#8216;<?=single_cat_title();?>&#8217;</div>
<?php elseif (is_tag()) :?>
        <div class="banner__headline">Posts Tagged &#8216;<?=single_tag_title();?>&#8217;</div>
<?php elseif (is_day()) :?>
        <div class="banner__headline">Archive for <?php the_time('F jS, Y');?></div>
<?php elseif (is_month()) :?>
        <div class="banner__headline">Archive for <?php the_time('F, Y');?></div>
<?php elseif (is_year()) :?>
        <div class="banner__headline">Archive for <?php the_time('Y');?></div>
<?php elseif (is_404()) :?>
        <div class="banner__headline">404 Not Found</div>
<?php else :?>
        <div class="banner__headline"><?php the_title();?></div>
<?php endif;?>
<?php endif;?>
        </h1>
<?php if (get_field('header_cta_url') && !is_search()) :?>
        <a href="<?php the_field('header_cta_url');?>" class="btn banner__cta"><?php the_field('header_cta_text');?></a>
<?php endif;?>
    </header>
</div><!-- .banner -->
