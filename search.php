<?php
/*
Template Name: Search
*/
?>

<?php include(TEMPLATEPATH . '/header.php'); ?>

<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<article>

		<div class="container container--md">
			<?php the_content(); ?>

			<div class="search-results">
				<script>
					(function() {
						var cx = '<?=env('GOOGLE_CSE_CX')?>';
						var gcse = document.createElement('script');
						gcse.type = 'text/javascript';
						gcse.async = true;
						gcse.src = 'https://cse.google.com/cse.js?cx=' + cx;
						var s = document.getElementsByTagName('script')[0];
						s.parentNode.insertBefore(gcse, s);
					})();
				</script>
				<gcse:searchresults-only></gcse:searchresults-only>
			</div>
		</div>
	</article>

<?php endwhile; endif; ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
