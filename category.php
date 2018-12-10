<?php include(TEMPLATEPATH . '/header.php'); ?>

<div class="banner">
		
	<div class="container banner__container">
			
		<header class="banner__header">
					    
		    <h1 class="banner__headline"><?php single_cat_title(); ?></h1>
		    				    				    
		</header>
			
	</div>
		
</div>

<article class="posts">

	<div class="container">
				
		<div class="post-list">
		
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
				<div class="post-list__item">
					
					<?php if (has_post_thumbnail() ) { ?>
					
						<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail' );?>
					
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="post-list__image" style="background-image: url('<?php echo $thumb['0'];?>')"></a>
					
					<?php } else { ?>
					
						<a href="<?php the_permalink(); ?>" class="post-list__image post-list__image--placeholder"></a>
					
					<?php } ?>
					
					<div class="post-list__content">
									
						<h3 class="post-list__headline"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><h3>
						
						<div class="post-list__excerpt"><?php the_excerpt(); ?></div>
											
					</div>
						
				</div>
		
			<?php endwhile; endif; ?>
		
		</div>
	
	</div>

</article>

<?php get_footer(); ?>



