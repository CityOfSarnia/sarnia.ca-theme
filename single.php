<?php include(TEMPLATEPATH . '/header.php'); ?>

<?php get_header(); ?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
		<div class="banner">
		
			<header class="banner__header">
				
				<div class="container">
				
					<?php if( get_field('banner_headline') ) { ?>
				    
				    	<h2 class="banner__headline"><?php the_field('banner_headline');?></h2>
	                	
					<?php } else { ?>
					
						<h2 class="banner__headline">Blog</h2>
					
					<?php } ?>
					
					<?php if( get_field('banner_cta_url') ) { ?>
				    
					    <a href="<?php the_field('banner_cta_url');?>" class="btn banner__cta"><?php the_field('banner_cta_name');?></a>
				    
				    <?php } ?>
			    
			    </div>
			    
			</header>
			
			<?php if ( has_post_thumbnail() ) { ?>
			
				<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'article-banner' );?>
			
				<div class="banner__image" style="background-image: url('<?php echo $thumb['0'];?>')"></div>
			
			<?php } ?>
			
		</div>
	
		<article>
			
			<div class="container container--min">
				
				<header class="post__header">
					
					<h1 class="post__headline"><?php the_title(); ?></h1>
					
				</header>
			
				<?php the_content(); ?>
			
			</div>
		
		</article>
								
	<?php endwhile; endif; ?>

<?php get_footer(); ?>