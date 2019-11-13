<?php /* Template Name: Search */ ?>

<?php
get_header();
if (have_posts() && get_search_query()) :
?>
                <article class="posts">
                    <div class="container container--md">
                        <div class="search-results">
<?php 
    while (have_posts()):
        the_post();
        get_template_part('template-parts/content/search', 'excerpt');
    endwhile;
    sarnia_number_pagination($wp_query);
?>
                        </div><!-- .search-results -->
                    </div><!-- .container.container--md -->
                </article><!-- .posts -->
<?php 
else:
    get_template_part('template-parts/content/post', 'none');
endif;
get_footer();
?>
