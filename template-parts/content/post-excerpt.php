<div id="post-<?php the_ID();?>" class="post-list__item">
    <h3 class="post-list__headline">
        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
    </h3><!-- .post-list__headline -->
    <p class="post-list__excerpt"><?php echo get_the_excerpt(); ?></p>
</div><!-- #post-<?php the_ID();?> -->
