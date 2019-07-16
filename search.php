<?php
/*
Template Name: Search
*/
?>

<?php include(TEMPLATEPATH . '/header.php'); ?>

<?php get_header(); ?>

<?php if (have_posts()): ?>
	<article>
		<div class="container container--md">
			<div class="search-results">
				<?php while (have_posts()) {
					the_post();
					the_title('<div>', '</div>');
					the_excerpt();
				}
				// todo: paginate
				?>
			</div>
		</div>
	</article>
<?php endif ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
