<?php
$loop = new WP_Query(array('post_type' => 'notifications', 'filter' => 'feature', 'posts_per_page' => 1));
while ($loop->have_posts()): $loop->the_post();
    $terms = get_the_terms($post->ID, 'notification-icon');
    if ($terms) :
        $terms_slugs = array();
        foreach ($terms as $term) :
            $terms_slugs[] = $term->slug;
        endforeach;
        $icon = $terms_slugs[0];
    else :
        $icon = 'default-notification';
    endif;
?>
<div class="feature-notification">
    <div class="container feature-notification__wrapper">
        <div class="feature-notification__icon">
<?php get_template_part('/assets/img/icons/inline', $icon . '.svg');?>
        </div><!-- .feature-notification__icon -->
        <div class="feature-notification__main">
            <h4 class="feature-notification__headline"><?php the_title();?></h4>
            <p class="feature-notification__text"><?=get_the_content();?></p>
        </div><!-- .feature-notification__icon -->
    </div><!-- .container.feature-notification__wrapper -->
</div><!-- .feature-notification -->
<?php
endwhile;
wp_reset_query();
?>