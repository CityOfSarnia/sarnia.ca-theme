<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<article id="post-<?php the_ID();?>">
		<div class="container container--min content">
<?php the_content(); ?>
		</div><!-- .container.container--min.content -->
	</article><!-- #post-<?php the_ID();?> -->
<?php endwhile; endif; ?>
<?php get_footer(); ?>