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
				
				the_posts_pagination(array(
					'mid_size'  => 2,
					'prev_text' => '&lsaquo; <span class="nav-prev-text">Newer posts</span>',
					'next_text' => '<span class="nav-next-text">Older posts</span> &rsaquo;',
				));
				?>
			</div>
		</div>
	</article>
<?php endif ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
