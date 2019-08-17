<?php /* Template Name: Search */ ?>

<?php get_header();?>

<?php if (have_posts() && get_search_query()): ?>

<article>
    <div class="container container--md">
        <div class="search-results">
            <?php while (have_posts()): ?>
            <?php the_post();?>
            <?php get_template_part('template-parts/content/content', 'excerpt');?>
            <?php endwhile;?>
            <?php sarnia_number_pagination();?>
        </div>
    </div>
</article>
<?php else: ?>
<?php get_template_part('template-parts/content/content', 'none');?>
<?php endif?>

<?php get_sidebar();?>

<?php get_footer();?>