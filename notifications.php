<?php /* Template Name: Notifications */ ?>

<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<article>
    <div class="container">
        <?php the_content(); ?>
        <div class="notification-btn">
            <a class="btn btn--center" href="https://member.everbridge.net/index/892807736721815#/login" target="_blank" rel="noopener">
                Sign up today!
            </a><!-- .btn.btn--center -->
        </div><!-- .notification-btn -->
        <ul class="notification-list">
<?php
$loop = new WP_Query(array('post_type' => 'notifications', 'posts_per_page' => -1));
while ($loop->have_posts()) : $loop->the_post();
    $terms = get_the_terms($post->ID, 'notification-icon');
    if ($terms):
        $terms_slugs = array();
        foreach ($terms as $term):
            $terms_slugs[] = $term->slug;
        endforeach;
    $icon = $terms_slugs[0];
    else:
        $icon = 'default-notification';
    endif; 
?>
            <li id="post-<?php the_ID();?>" class="notification-list__item">
                <div class="notification__icon">
<?php get_template_part('/assets/img/icons/inline', $icon . '.svg'); ?>
                </div>
                <header class="notification__header">
                    <h2 class="notification__headline"><?php the_title(); ?></h2>
                    <h4 class="notification__date"><?php the_field('notification_date'); ?></h4>
                </header><!-- .notification__header -->
                <p class="notification__text"><?= get_the_content(); ?></p>
            </li><!-- #post-<?php the_ID();?> -->
<?php endwhile; ?>
            <?php wp_reset_query(); ?>
        </ul><!-- .notification-list -->
    </div><!-- .container -->

</article>

<?php endwhile; ?>
<?php endif; ?>
<?php get_footer(); ?>