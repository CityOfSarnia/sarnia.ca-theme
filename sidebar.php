<?php
?>
 <aside id="sidebar">

    <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Sidebar Widgets')) : else : ?>

        <!-- All this stuff in here only shows up if you DON'T have any widgets active in this zone -->

    	<h2>Archives</h2>
    	<ul>
    		<?php wp_get_archives('type=monthly'); ?>
    	</ul>

    	<h2>Meta</h2>
    	<ul>
    		<?php wp_register(); ?>
    		<li><?php wp_loginout(); ?></li>
    		<li><a href="http://wordpress.org/" title="Powered by WordPress.">WordPress</a></li>
    		<?php wp_meta(); ?>
    	</ul>

    	<h2>Subscribe</h2>
    	<ul>
    		<li><a href="<?php bloginfo('rss2_url'); ?>">Entries (RSS)></a></li>
    		<li><a href="<?php bloginfo('comments_rss2_url'); ?>">Comments (RSS)</a></li>
    	</ul>

	<?php endif; ?>

</aside>
