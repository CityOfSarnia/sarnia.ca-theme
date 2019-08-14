<?php get_header(); ?>

<article class="posts">

	<div class="container container--min">

		<div class="post-list">

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<div class="post-list__item">

					<h3 class="post-list__headline"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

					<p class="post-list__excerpt"><?php echo get_the_excerpt(); ?></p>

				</div>

			<?php endwhile; endif; ?>

		</div>

		<?php sarnia_number_pagination(); ?>

	</div>

</article>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
