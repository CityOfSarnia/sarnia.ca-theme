<?php get_header(); ?>

<article class="posts">

	<div class="container container--min">

		<div class="post-list">

			<?php if ( have_posts() ):

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
				while ($wp_query->have_posts()) : $wp_query->the_post();
			?>

			<div class="post-list__item">

				<h3 class="post-list__headline"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

				<p class="post-list__excerpt"><?php echo get_the_excerpt(); ?></p>

			</div>

			<?php
				endwhile;
				wp_reset_postdata();
			endif; ?>

		</div>

		<?php
			global $wp_query;

			$big = 999999999;
			echo '<div class="paginate-links">';
				echo paginate_links( array(
				'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format' => '?paged=%#%',
				'prev_text' => __('<<'),
				'next_text' => __('>>'),
				'current' => max( 1, get_query_var('paged') ),
				'total' => $wp_query->max_num_pages
				) );
			echo '</div>';
		?>

	</div>

</article>

<?php get_sidebar(); ?>

<?php get_footer(); ?>