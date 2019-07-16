<article id="post-<?php the_ID(); ?>" <?php post_class('search-result'); ?>>
	<?php the_title(sprintf('<h2 class="search-result__title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>' ); ?>
  
  <a href="<?php echo get_permalink() ?>" class="search-result__url"><?php echo esc_url(get_permalink()) ?></a>

	<div class="search-result__excerpt">
		<?php the_excerpt(); ?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
