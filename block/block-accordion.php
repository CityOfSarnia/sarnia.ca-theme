<?php
/**
 * Block Name: Accordion
 *
 * This is the template that displays the accordion block.
 */
?>

<?php if( get_field('accordion_heading_text') &&  get_field('accordion_content') ) { ?>

  <article class="accordion js-accordion__toggle">

    <header class="accordion__header">

      <<?php the_field('accordion_heading_level'); ?> class="accordion__headline"><?php the_field('accordion_heading_text'); ?></<?php the_field('accordion_level'); ?>>

      <div class="accordion__toggle"></div>

    </header>

    <div class="accordion__content">

      <?php the_field('accordion_content'); ?>

    </div>

  </article>

<?php } else { ?>

  <p>Create an accordion...</p>

<?php } ?>
