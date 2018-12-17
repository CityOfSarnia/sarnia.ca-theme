<?php
/**
 * Block Name: Navigation
 *
 * This is the template that displays the navigation block.
 */
?>

<?php if( get_field('menu') ) { ?>

  <div class="navigation-card">

    <?php if( get_field('menu_image') ) { ?>

      <div class="navigation-card__image" style="background-image: url(<?php $image = get_field('menu_image'); echo($image['sizes']['large']); ?>) !important;"></div>

    <?php } ?>

    <div class="navigation-card__main">

      <?php if( get_field('menu_headline') ) { ?>

        <h2 class="navigation-card__headline"><?php the_field('menu_headline');?></h2>

      <?php } ?>

      <div class="navigation-card__menu"><?php the_field('menu'); ?></div>

    </div>

  </div>

<?php } else { ?>

  <p>Select a menu...</p>

<?php } ?>