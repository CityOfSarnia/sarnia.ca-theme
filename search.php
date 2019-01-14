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
						var cx = '011834652543007666948:m6gm5sunju8';
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
	</article>
							
<?php endwhile; endif; ?>

<?php get_footer(); ?>