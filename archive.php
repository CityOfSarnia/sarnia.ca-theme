<?php get_header(); ?>
				<article class="posts">
					<div class="container container--min">
						<div class="post-list">
<?php
if ( have_posts() ):

	$query_args = [
		'post_type'     => 'post',
		'orderby'       => 'date',
		'order'         => 'desc',
		'paged'         => (get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1),
		'category_name' => get_query_var('category_name'),
	];

	if (is_date()):
		$query_args['year'] = get_the_time('Y');	
		if (is_month()):
			$query_args['monthnum'] = get_the_time('m');
		elseif (is_day()):
			$query_args['monthnum'] = get_the_time('m');
			$query_args['day'] = get_the_time('d');	
		endif;
	endif;

	$wp_query = new WP_Query( $query_args );

	while ($wp_query->have_posts()) : 
		$wp_query->the_post();
		get_template_part('template-parts/content/post', 'excerpt');
	endwhile;
	wp_reset_postdata();
	sarnia_number_pagination($wp_query);
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
