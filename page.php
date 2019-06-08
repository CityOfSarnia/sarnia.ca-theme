<?php include(TEMPLATEPATH . '/header.php'); ?>

<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<article>

		<div class="container container--min content">

			<?php the_content(); ?>

		</div>

	</article>

<?php endwhile; endif; ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
