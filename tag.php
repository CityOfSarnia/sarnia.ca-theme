<?php get_header(); ?>

<article>

	<div class="section-header">

		<div class="section-header-top"></div>

		<h1><?php single_tag_title(); ?></h1>

		<div class="section-header-bottom"></div>

	</div>

	<div class="excerpt-block clearfix">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<div class="excerpt">

				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('excerpt-thumb', array('alt' => ''.get_the_title().'', 'title' => ''.get_the_title().''));?></a>

				<div class="excerpt-content">

					<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>

					<div class="excerpt-header-line"></div>

					<h3><?php the_time('F j, Y'); ?></h3>

				</div>

			</div>

		<?php endwhile; endif; ?>

	</div>

</article>

<?php get_footer(); ?>
