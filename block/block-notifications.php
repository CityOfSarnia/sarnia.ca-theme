<?php
/**
 * Block Name: Notifications
 *
 * This is the template that displays the notifications block.
 */
?>

<div class="recent-notifications">
    <div class="recent-notification-list--top">
      <div class="container recent-notification-list">
        <div class="recent-notification-list__item recent-notification-list--collapse">
          <a href="#" class="btn btn--outline">Subscribe</a>
        </div>
        <!-- Recent Notification Query for Headers and screen readers -->
        <?php $loop = new WP_Query( array( 'post_type' => 'notifications', 'posts_per_page' => 3 ) ); ?>    
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
            $post_id = get_the_ID();
          ?>
          <a href="/notifications" class="recent-notification-list__item">
            <div class="recent-notification__icon"><?php include(TEMPLATEPATH . '/assets/img/icons/' . $icon . '.svg'); ?></div>
            <header class="recent-notification__header">
              <h4 class="recent-notification__headline"><?php the_title(); ?></h4>
              <p class="recent-notification__date"><?php the_field('notification_date', $post_id); ?></p>
            </header>
            <p class="recent-notification__text hidden"><?php echo get_the_excerpt(); ?></p>
          </a>
        <?php endwhile; ?>
        <?php wp_reset_query(); ?>
        <div class="recent-notification-list__item">
          <a href="/notifications" class="btn btn--outline">More</a>
        </div>
      </div>
    </div>

    <div class="recent-notification-list--bottom" aria-hidden="true">
      <div class="container recent-notification-list ">
        <div class="recent-notification-list__item recent-notification-list--collapse"></div>
        <!-- Recent Notification Query for Expert Only -->
        <?php $loop = new WP_Query( array( 'post_type' => 'notifications', 'posts_per_page' => 3 ) ); ?>    
        <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
          <a href="/notifications" class="recent-notification-list__item">
            <p class="recent-notification__text"><?php echo get_the_excerpt(); ?></p>
          </a>
        <?php endwhile; ?>
        <?php wp_reset_query(); ?>
        <div class="recent-notification-list__item"></div>
      </div>
    </div>
</div>