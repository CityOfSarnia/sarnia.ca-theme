<?php get_header(); ?>
				<article class="posts">
					<div class="container container--min">
						<div class="post-list">
<?php
if ( have_posts() ):
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	if (is_day()):
		$currYear = get_the_time('Y');
		$currMonth = get_the_time('m');
		$currDay = get_the_time('d');
		$wp_query = new WP_Query();
		$wp_query->query('year=' . $currYear . '&monthnum=' . $currMonth . '&day=' . $currDay . '&post_type=post&paged=' . $paged);
	elseif (is_month()):
		$currYear = get_the_time('Y');
		$currMonth = get_the_time('m');
		$wp_query = new WP_Query();
		$wp_query->query('year=' . $currYear . '&monthnum=' . $currMonth . '&post_type=post&paged=' . $paged);
	elseif (is_year()):
		$currYear = get_the_time('Y');
		$wp_query = new WP_Query();
		$wp_query->query('year=' . $currYear . '&post_type=post&paged=' . $paged);
	endif;
	while ($wp_query->have_posts()) : 
		$wp_query->the_post();
		get_template_part('template-parts/content/post', 'excerpt');
	endwhile;
	wp_reset_postdata();
	sarnia_number_pagination();
?>
						</div><!-- .post-list -->
					</div><!-- .container.container--min -->
				</article><!-- .posts -->
<?php
else:
	get_template_part('template-parts/content/post', 'none');
endif;
get_footer();
?>
