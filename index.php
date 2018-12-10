<?php
/*
Template Name: Home
*/
?>

<?php include(TEMPLATEPATH . '/header.php'); ?>

<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<article>

		<div class="container">
			
			<?php the_content(); ?>
		
		</div>
	
	</article>
							
<?php endwhile; endif; ?>

<?php get_footer(); ?>