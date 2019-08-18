<form id="searchform" role="search" method="get" class="searchform" action="<?=home_url('/');?>">
    <div id="search">
        <label class="screen-reader-text" for="s"><?=_x('Search for:', 'label')?></label>
        <input type="search" placeholder="<?=esc_attr_x('Search …', 'placeholder')?>" value="<?=get_search_query()?>" name="s" title="<?=esc_attr_x('Search for:', 'label')?>" required>
        <label>
            <input type="submit" value="<?=esc_attr_x('Search', 'submit button')?>">
<?php get_template_part('/assets/img/icons/inline', 'search.svg');?>
        </label>
    </div><!-- #search -->
</form><!-- #searchform -->
