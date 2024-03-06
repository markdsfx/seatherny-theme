<?php
/**
 * Navigation Template - Right Side
 *
 * @package SDEV
 * @subpackage SDEV WP
 * @since SDEV WP Theme 2.0
 */  
?>
<?php
    $main_menu = \SDEV\Utils::getMenuItems('Main Menu', true);
    foreach($main_menu as $key => $fi) : 
        $menu_item = $fi['item']; 
        

        $classes=''; 
        if(!empty($menu_item->classes)){ 
            foreach($menu_item->classes as $cls) :
                $classes .= $cls.' ';
            endforeach;
        } ?>
        <?php if(empty($fi['submenu'])) { ?>
            
            <a href="<?= $menu_item->url; ?>" data-home="<?= get_site_url(null, '?gt='.ltrim($menu_item->url,'#')); ?>" target="<?= $menu_item->target ?>" data-id="<?= $menu_item->ID; ?>" class="<?= $classes ?> <?= \SDEV\Utils::getMenuItemClass( (rtrim(get_permalink(), '/').'/'), $menu_item->url) ?>"><?= $menu_item->title; ?></a>
        <?php } else { 
            $parent_url = ($menu_item->url == '#' || empty($menu_item->url)) ? 'javascript:void(0)' : $menu_item->url; ?>
            <div class="has-sub-menu">
                <a href="<?= $parent_url; ?>" class="parent-menu" data-id="<?= $menu_item->ID; ?>">
                    <?= $menu_item->title; ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M5 7.5L10 12.5L15 7.5" class="caret-down" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
                <ul class="sub-nav">
                    <?php foreach($fi['submenu'] as $sub) :
                        
                        $icon = get_field('menu_image', $sub);

                        $classes='';
                        if(!empty($sub->classes)){ 
                            foreach($sub->classes as $cls) :
                                $classes .= $cls.' ';
                            endforeach;
                        } ?>
                        <li>
                            <a href="<?= $sub->url; ?>" target="<?= $sub->target ?>" class="<?= $classes ?>">
                                <div class="icon-wrapper">
                                    <img class="menu-icon" src="<?= $icon ?>">
                                </div>
                                <div class="title-wrapper">
                                    <span><?= $sub->title; ?></span>
                                    <span><?= $sub->description; ?></span>
                                </div>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php } 
    endforeach; 
?>
