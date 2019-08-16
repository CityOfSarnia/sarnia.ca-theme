<div class="footer__main">
    <div class="container">
        <div class="footer__columns">

            <div class="footer__logo">
                <a href="/" class="logo">City of Sarnia</a>
                <p class="logo-copyright__text">&copy;<?php echo date("Y"); echo " "; echo bloginfo('name'); ?></p>
            </div>
                
            <div class="footer__contact">

                <div class="contact-list">

                    <h2 class="contact-list__headline">Contact the City</h2>

                    <div class="contact-list__item contact-item">
                        <?php if( get_field('phone', 'option') ) : ?>
                        <p class="contact-item__headline">Phone</p>
                        <p class="contact-item__text"><?php the_field('phone', 'option'); ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="contact-list__item contact-item">
                        <?php if( get_field('address', 'option') ) : ?>
                        <p class="contact-item__headline">Address</p>
                        <p class="contact-item__text"><?php the_field('address', 'option'); ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="contact-list__item contact-item">
                        <?php if( get_field('hours', 'option') ) : ?>
                        <p class="contact-item__headline">Hours</p>
                        <p class="contact-item__text"><?php the_field('hours', 'option'); ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="contact-list__item contact-item">
                        <?php if( get_field('email', 'option') ) : ?>
                        <p class="contact-item__headline">Email</p>
                        <p class="contact-item__text"><a
                                href="mailto:<?php the_field('email', 'option'); ?>"><?php the_field('email', 'option'); ?></a>
                        </p>
                        <?php endif; ?>
                    </div>

                </div>

                <div class="footer-social">
                    <?php if( get_field('twitter', 'option') ) { ?>
                    <a href="<?php the_field('twitter', 'option'); ?>" class="social-links__icon"
                        aria-label="Visit Twitter"><?php get_template_part('/assets/img/icons/social/inline', 'twitter.svg'); ?></a>
                    <?php } ?>

                    <?php if( get_field('facebook', 'option') ) { ?>
                    <a href="<?php the_field('facebook', 'option'); ?>" class="social-links__icon"
                        aria-label="Visit Facebook"><?php get_template_part('/assets/img/icons/social/inline', 'facebook.svg'); ?></a>
                    <?php } ?>

                    <?php if( get_field('linkedin', 'option') ) { ?>
                    <a href="<?php the_field('linkedin', 'option'); ?>" class="social-links__icon"
                        aria-label="Visit LinkedIn"><?php get_template_part('/assets/img/icons/social/inline', 'linkedin.svg'); ?></a>
                    <?php } ?>

                    <?php if( get_field('youtube', 'option') ) { ?>
                    <a href="<?php the_field('youtube', 'option'); ?>" class="social-links__icon"
                        aria-label="Visit Youtube"><?php get_template_part('/assets/img/icons/social/inline', 'youtube.svg'); ?></a>
                    <?php } ?>

                    <?php if( get_field('instagram', 'option') ) { ?>
                    <a href="<?php the_field('instagram', 'option'); ?>" class="social-links__icon"
                        aria-label="Visit Instagram"><?php get_template_part('/assets/img/icons/social/inline', 'instagram.svg'); ?></a>
                    <?php } ?>
                </div>
            </div>
        </div><!-- .footer__columns -->
    </div><!-- .container -->
</div><!-- .footer__main -->