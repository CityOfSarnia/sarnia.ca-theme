<div class="footer__main">
    <div class="container">
        <div class="footer__columns">
            <div class="footer__logo">
                <a href="/" class="logo">City of Sarnia</a>
                <p class="logo-copyright__text">&copy;<?= date("Y"); echo " "; echo bloginfo('name'); ?></p>
            </div><!-- .footer__logo -->
            <div class="footer__contact">
                <div class="contact-list">
                    <h2 class="contact-list__headline">Contact the City</h2>
                    <div class="contact-list__item contact-item">
<?php if ($phone_option = get_field('phone', 'option')): ?>
                        <p class="contact-item__headline">Phone</p>
                        <p class="contact-item__text">
                            <a href="tel:+1-<?=$phone_option;?>"><?=$phone_option?></a>
<?php endif;?>
                    </div><!-- .contact-list__item contact-item -->
                    <div class="contact-list__item contact-item">
<?php if ($tollFree_option = get_field('tollFree', 'option')): ?>
                        <p class="contact-item__headline">Toll Free</p>
                        <p class="contact-item__text">
                            <a href="tel:+<?=$tollFree_option;?>"><?=$tollFree_option?></a>
<?php endif;?>
                    </div><!-- .contact-list__item contact-item -->
                    <div class="contact-list__item contact-item">
<?php if ($address_option = get_field('address', 'option')): ?>
                        <p class="contact-item__headline">Address</p>
                        <p class="contact-item__text"><?=$address_option;?></p>
<?php endif;?>
                    </div><!-- .contact-list__item contact-item -->
                    <div class="contact-list__item contact-item">
<?php if ($hours_option = get_field('hours', 'option')): ?>
                        <p class="contact-item__headline">Hours</p>
                        <p class="contact-item__text"><?=$hours_option;?></p>
<?php endif;?>
                    </div><!-- .contact-list__item contact-item -->
                    <div class="contact-list__item contact-item">
<?php if ($email_option = get_field('email', 'option')): ?>
                        <p class="contact-item__headline">Email</p>
                        <p class="contact-item__text">
                            <a href="mailto:<?=$email_option;?>"><?=$email_option;?></a>
                        </p>
<?php endif;?>
                    </div><!-- .contact-list__item contact-item -->
                </div><!-- .contact-list -->
                <div class="footer-social">
<?php if ($twitter_option = get_field('twitter', 'option')): ?>
                    <a href="<?=$twitter_option?>" class="social-links__icon" aria-label="Visit Twitter">
<?php get_template_part('/assets/img/icons/social/inline', 'twitter.svg');?>
                    </a><!-- .social-links__icon -->
<?php endif;?>
<?php if ($facebook_option = get_field('facebook', 'option')): ?>
                    <a href="<?=$facebook_option;?>" class="social-links__icon" aria-label="Visit Facebook">
<?php get_template_part('/assets/img/icons/social/inline', 'facebook.svg');?>
                    </a><!-- .social-links__icon -->
<?php endif;?>
<?php if ($linkedin_option = get_field('linkedin', 'option')): ?>
                    <a href="<?=$linkedin_option;?>" class="social-links__icon" aria-label="Visit LinkedIn">
<?php get_template_part('/assets/img/icons/social/inline', 'linkedin.svg');?>
                    </a><!-- .social-links__icon -->
<?php endif;?>
<?php if ($youtube_option = get_field('youtube', 'option')): ?>
                    <a href="<?=$youtube_option;?>" class="social-links__icon" aria-label="Visit Youtube">
<?php get_template_part('/assets/img/icons/social/inline', 'youtube.svg');?>
                    </a><!-- .social-links__icon -->
<?php endif;?>
<?php if ($instagram_option = get_field('instagram', 'option')): ?>
                    <a href="<?=$instagram_option;?>" class="social-links__icon" aria-label="Visit Instagram">
<?php get_template_part('/assets/img/icons/social/inline', 'instagram.svg');?>
                    </a><!-- .social-links__icon -->
<?php endif;?>
                </div><!-- .footer-social -->
            </div><!-- .footer__contact -->
        </div><!-- .footer__columns -->
    </div><!-- .container -->
</div><!-- .footer__main -->
