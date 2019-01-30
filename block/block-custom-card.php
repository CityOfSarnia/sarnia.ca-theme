<?php
/**
 * Block Name: Custom Card
 *
 * This is the template that displays the custom card block.
 */
?>

<?php if( get_field('custom_card_headline') ) { ?>

  <div class="post-card <?=card_colour(); ?>">

    <?php if( get_field('custom_card_image') ) { ?>

      <div class="card__image" style="background-image: url('<?php $image = get_field('custom_card_image'); echo($image['sizes']['large']); ?>')" alt="<?php the_field('custom_card_headline');?>"></div>

    <?php } ?>
		
    <div class="card__main">

      <?php if( get_field('custom_card_headline') ) { ?>

        <h4 class="card__headline">
          <a href="<?php the_field('custom_card_cta_url');?>"><?php the_field('custom_card_headline');?></a>
        </h4>

      <?php } ?>

      <?php if( get_field('custom_card_text') ) { ?>

        <p class="card__text"><?php the_field('custom_card_text');?></p>

      <?php } ?>

      <?php if( get_field('custom_card_cta_url') ) { ?>

        <div class="card__cta"><a href="<?php the_field('custom_card_cta_url');?>" class="btn btn--sm"><?php the_field('custom_card_cta_text');?></a></div>
      
      <?php } ?>

    </div>
  
  </div>

<?php } else { ?>

  <p>Create a custom card...</p>

<?php } ?>