<?php
/**
 * Footer Upper Template (Footer Block)
 *
 * @package SDEV
 * @subpackage SDEV WP
 * @since SDEV WP Theme 2.0
 */  

    $phone = get_field('gen_phone_number', 'options');
    $email = get_field('gen_email_address', 'options');
    $location = get_field('gen_location', 'options');
    $icon_class = (defined('FOOTER_ALT_CLASS')) ? '-light' : '';

?>
<div class="pf-upper container-block">
    <div id="get-in-touch">

        <div class="footer-main">
            <?php if( have_rows('footer_menu', 'options') ): ?>
            <ul class="footer-menu-block">
            <?php while( have_rows('footer_menu', 'options') ) : the_row(); ?>
                <li>
                <?php 
                $link = get_sub_field('menu_item', 'options');
                if( $link ): 
                    $link_url = $link['url'];
                    $link_title = $link['title'];
                    $link_target = $link['target'] ? $link['target'] : '_self';
                ?>
                    <a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                <?php endif; ?>
                </li>
            <?php endwhile; ?>
            </ul>
            <?php endif; ?>
        </div>

    </div>
</div>