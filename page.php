<?php include(TEMPLATEPATH . '/header.php'); ?>

<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<div class="banner" style="background-image: url(<?php $image = get_field('banner_image'); echo($image['sizes']['banner']); ?>) !important;">
		
		<div class="container">
		
			<header class="banner__header">
				
				<?php if( get_field('banner_headline') ) { ?>
			    
			    	<h1 class="banner__headline"><?php the_field('banner_headline');?></h1>
	            	
				<?php } else { ?>
				
					<h1 class="banner__headline"><?php the_title(); ?></h1>
				
				<?php } ?>
				
				<?php if( get_field('banner_text') ) { ?>
				
					<p class="banner__text"><?php the_field('banner_text');?></p>
				
				<?php } ?>
				
				<?php if( get_field('banner_cta_url') ) { ?>
			    
				    <a href="<?php the_field('banner_cta_url');?>" class="btn banner__cta"><?php the_field('banner_cta_text');?></a>
			    
			    <?php } ?>
			    
			</header>
		
		</div>
		
	</div>

	<article>
		
		<div class="container container--min">
				
			<?php the_content(); ?>
			
		</div>
	
	</article>
							
<?php endwhile; endif; ?>

<?php get_footer(); ?>