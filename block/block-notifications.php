<?php
/**
 * Block Name: Notifications
 *
 * This is the template that displays the notifications block.
 */
?>

<div class="recent-notifications">

  <div class="container recent-notifications__wrapper">

    <?php $loop = new WP_Query( array( 'post_type' => 'notifications', 'posts_per_page' => 3 ) ); ?>        
    <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
      <?php the_title(); ?>
      <?php the_excerpt(); ?>
    <?php endwhile; ?>			
    <?php wp_reset_query(); ?>

  </div>

</div>