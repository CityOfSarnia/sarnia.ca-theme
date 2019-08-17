<?php
get_header();
if (have_posts()) : 
?>
				<article class="posts">
					<div class="container container--min">
						<div class="post-list">
<?php 
	while (have_posts()):
		the_post();
		get_template_part('template-parts/content/post', 'excerpt');
	endwhile;
	sarnia_number_pagination();
?>
						</div><!-- .post-list -->
					</div><!-- container.container--min -->
				</article><!-- .posts -->
<?php
else:
	get_template_part('template-parts/content/search', 'none');
endif;
get_footer();
?>
