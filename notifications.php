<?php /* Template Name: Notifications */ ?>

<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<article>

    <div class="container">

        <?php the_content(); ?>

        <div class="notification-btn"><a class="btn btn--center" href="https://member.everbridge.net/index/892807736721815#/login" target="_blank" rel="noopener">Sign up today!</a></div>

        <ul class="notification-list">
            <?php $loop = new WP_Query(array('post_type' => 'notifications', 'posts_per_page' => -1)); ?>
            <?php while ($loop->have_posts()) : $loop->the_post(); ?>
            <?php $terms = get_the_terms($post->ID, 'notification-icon'); ?>
			<?php if ($terms): ?>
				<?php $terms_slugs = array(); ?>
				<?php foreach ($terms as $term): ?>
					<?php $terms_slugs[] = $term->slug; ?>
				<?php endforeach; ?>
				<?php $icon = $terms_slugs[0]; ?>
			<?php else: ?>
				<?php $icon = 'default-notification'; ?>
			<?php endif; ?>
            <li class="notification-list__item">
                <div class="notification__icon"><?php get_template_part('/assets/img/icons/inline', $icon . '.svg'); ?>
                </div>
                <header class="notification__header">
                    <h2 class="notification__headline"><?php the_title(); ?></h2>
                    <h4 class="notification__date"><?php the_field('notification_date'); ?></h4>
                </header>
                <p class="notification__text"><?= get_the_content(); ?></p>
            </li>
            <?php endwhile; ?>
            <?php wp_reset_query(); ?>
        </ul>
    </div>

</article>

<?php endwhile; ?>
<?php endif; ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>