<?php
/*
Template Name: Search
*/
?>

<?php include(TEMPLATEPATH . '/header.php'); ?>

<?php get_header(); ?>

<?php if (have_posts() && get_search_query()): ?>

	<article>
		<div class="container container--md">
			<div class="search-results">
				<?php while (have_posts()) {
					the_post();
					get_template_part( 'partials/content/content', 'excerpt' );
				}
		                sarnia_number_pagination();
				?>
			</div>
		</div>
	</article>
<?php else: ?>
	<?php get_template_part( 'partials/content/content', 'none' ); ?>
<?php endif ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
