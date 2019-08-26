<article id="post-<?php the_ID();?>" <?php post_class('search-result');?>>
    <?php the_title(sprintf('<h2 class="search-result__title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>');?>
    <a href="<?=get_permalink()?>" class="search-result__url"><?=esc_url(get_permalink())?></a>
    <p><?= "\nPublished: " . get_the_date('l, F j, Y'); ?></p>
    <div class="search-result__excerpt">
        <?php the_excerpt();?>
    </div><!-- .search-result__excerpt -->
</article><!-- #post-<?php the_ID();?> -->
