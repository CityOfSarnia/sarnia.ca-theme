<?php
/*
Template Name: Notifications
*/
?>

<?php include(TEMPLATEPATH . '/header.php'); ?>

<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<article>

		<div class="container">
			
			<?php the_content(); ?>

			<?php $loop = new WP_Query( array( 'post_type' => 'notifications', 'posts_per_page' => -1 ) ); ?>        
			<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
				<?php the_title(); ?>
				<?php the_content(); ?>
			<?php endwhile; ?>			
			<?php wp_reset_query(); ?>
		
		</div>
	
	</article>
							
<?php endwhile; endif; ?>

<?php get_footer(); ?>