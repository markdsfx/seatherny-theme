<?php
/**
 * Page Header Template Block (Header Block)
 *
 * @package SDEV
 * @subpackage SDEV WP
 * @since SDEV WP Theme 2.0
 */  
    $header_type = get_field('header_type') ?: 'default';
    $logo_type = get_field('logo_type', 'options');
    $alt_logo_type = get_field('alt_logo_type', 'options');
    $mobile_logo_type = get_field('mobile_logo_type', 'options');

?>
<header id="page-header" class="page-header--default">
    <div id="main-header" class="upper-header-wrapper container-block">
        <div class="uh-content content-block">
            <div class="tb-wr uhc-table">
                <div class="tb-c-wr logo-cell va-middle">
                    <?php if($header_type == 'home') : ?>
                        <a href="<?= get_site_url(null, ''); ?>" class="main-logo main-logo--home">
                            <?php if($logo_type == 'svg') : ?>
                                    <?= get_field('main_logo_svg', 'options') ?>
                            <?php else: 
                                    $logo = get_field('main_logo','options'); ?>
                                    <img src="<?= $logo['url'] ?>" alt="<?= $logo['alt'] ?>" />
                            <?php endif; ?>
                        </a>
                    <?php else : ?>
                        <a href="<?= get_site_url(null, ''); ?>" class="main-logo">
                            <?php if($mobile_logo_type == 'svg') : ?>
                                    <?= get_field('mobile_logo_svg', 'options') ?>
                            <?php else: 
                                    $logo = get_field('mobile_logo','options'); ?>
                                    <img src="<?= $logo['url'] ?>" alt="<?= $logo['alt'] ?>" />
                            <?php endif; ?>
                        </a>
                    <?php endif; ?>
                    <a href="<?= get_site_url(null, ''); ?>" class="mobile-logo">
                        <?php if($mobile_logo_type == 'svg') : ?>
                                <?= get_field('mobile_logo_svg', 'options') ?>
                        <?php else: 
                                $logo = get_field('mobile_logo','options'); ?>
                                <img src="<?= $logo['url'] ?>" alt="<?= $logo['alt'] ?>" />
                        <?php endif; ?>
                    </a>
                    <a href="<?= get_site_url(null, ''); ?>" class="alt-logo">
                        <?php if($alt_logo_type == 'svg') : ?>
                                <?= get_field('alt_logo_svg', 'options') ?>
                        <?php else: 
                                $logo = get_field('alt_logo','options'); ?>
                                <img src="<?= $logo['url'] ?>" alt="<?= $logo['alt'] ?>" />
                        <?php endif; ?>
                    </a>
                </div>
                <div class="tb-c-wr nav-cell nav-cell--right va-middle">
                    <nav class="main-navigation desktop-only">
                        <?php get_template_part('src/views/partials/header', 'navigation-right');  ?>
                    </nav>
                    <div id="hamburger-menu" class="mobile-menu-trigger mobile-only">
                        <div class="hm-bar"></div>
                        <div class="hm-bar"></div>
                        <div class="hm-bar"></div>
                    </div>
                    <div id="mobile-menu">
                        <div class="mm-main-wrap">
                            <div class="mobile-nav-wrapper">
                                <nav>
                                    <?php get_template_part('src/views/partials/header', 'navigation-right');  ?>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>