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

			<div class="notification-btn"><a class="btn btn--center" href="https://member.everbridge.net/index/892807736721815#/login" target="_blank" rel="noopener">Subscribe To Notifications</a></div>

			<ul class="notification-list">
				<?php $loop = new WP_Query( array( 'post_type' => 'notifications', 'posts_per_page' => -1 ) ); ?>        
				<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
					<?php
						$terms = get_the_terms( $post->ID, 'notification-icon' );
						if ($terms) {
							$terms_slugs = array();
							foreach ( $terms as $term ) {
									$terms_slugs[] = $term->slug;
							}
							$icon = $terms_slugs[0];
						} else {
							$icon = 'default-notification';
						}
					?>
					<li class="notification-list__item">
						<div class="notification__icon"><?php include(TEMPLATEPATH . '/assets/img/icons/' . $icon . '.svg'); ?></div>
						<header class="notification__header">
							<h2 class="notification__headline"><?php the_title(); ?></h2>
							<h4 class="notification__date"><?php the_field('notification_date'); ?></h4>
						</header>
						<p class="notification__text"><?php echo get_the_content(); ?></p>
					</li>
				<?php endwhile; ?>
				<?php wp_reset_query(); ?>
			</ul>
		</div>
	
	</article>
							
<?php endwhile; endif; ?>

<?php get_footer(); ?>