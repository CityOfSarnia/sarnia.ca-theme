<?php /* Template Name: Search */ ?>

<?php get_header();?>
<?php if (have_posts() && get_search_query()): ?>
<article>
    <div class="container container--md">
        <div class="search-results">
<?php 
while (have_posts()):
    the_post();
    get_template_part('template-parts/content/content', 'excerpt');
endwhile;
sarnia_number_pagination();
?>
        </div><!-- .search-results -->
    </div><!-- .container container--md -->
</article>
<?php else: ?>
<?php get_template_part('template-parts/content/content', 'none');?>
<?php endif?>
<?php get_sidebar();?>
<?php get_footer();?>