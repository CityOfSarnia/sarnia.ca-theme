<nav class="primary-menu" role="navigation">
<?php wp_nav_menu(array( 
    'theme_location' => 'primary-menu',
    'container_class' => 'primary-menu__container',
    'walker' => new Add_button_of_Sublevel_Walker
)); ?>

</nav><!-- .primary-menu -->
