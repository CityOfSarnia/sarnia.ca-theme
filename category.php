<?php get_header(); ?>
<article class="posts">
	<div class="container container--min">
		<div class="post-list">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div id="post-<?php the_ID();?>" class="post-list__item">
				<h3 class="post-list__headline">
					<a href="<?php the_permalink(); ?>">
						<?php the_title(); ?>
						
					</a>
				</h3><!-- .post-list__headline -->
				<p class="post-list__excerpt"><?php echo get_the_excerpt(); ?></p>
			</div><!-- #post-<?php the_ID();?> -->
<?php endwhile; endif; ?>
		</div><!-- .post-list -->
<?php sarnia_number_pagination(); ?>
	</div><!-- container.container--min -->
</article><!-- .posts -->
<?php get_footer(); ?>
