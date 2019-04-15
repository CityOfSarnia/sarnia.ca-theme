<?php get_header(); ?>

<article class="posts">

	<div class="container container--min">

		<div class="post-list">

			<?php if ( have_posts() ):

				$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

				$currCat = get_category( get_query_var( 'cat' ) );
				$cat_name = $currCat->name;
				$cat_id   = get_cat_ID( $cat_name );

				$wp_query = new WP_Query();
				$wp_query->query( 'showposts=10&post_type=post&paged=' . $paged . '&cat=' . $cat_id );

				while ( $wp_query->have_posts() ) : $wp_query->the_post();

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
