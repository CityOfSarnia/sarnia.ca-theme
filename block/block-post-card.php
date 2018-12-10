<?php
/**
 * Block Name: Post Card
 *
 * This is the template that displays the post card block.
 */
?>

<?php

$post_object = get_field('post_card');
if( $post_object ) {
  
$post = $post_object;
setup_postdata( $post );
?>

<div class="card">

  <?php if ( has_post_thumbnail($post->ID) ) { ?>

    <?php echo get_the_post_thumbnail($post->ID, 'medium'); ?>

  <?php } ?>

  <div class="card__main">

    <h4 class="card__headline"><a href="<?php the_permalink($post->ID); ?>"><?php echo get_the_title($post->ID); ?></a></h4>

    <p class="card__text"><?php echo get_the_excerpt($post->ID); ?></p>

    <div class="card__cta"><a href="<?php the_permalink($post->ID); ?>" class="btn btn--sm">Learn More</a></div>

  </div>

</div>

<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>

<?php } else { ?>

  <p>Select a post...</p>

<?php } ?>