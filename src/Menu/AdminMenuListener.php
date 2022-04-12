<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * You can find more information about us on https://bitbag.io and write us
 * an email on hello@bitbag.io.
 */

declare(strict_types=1);

namespace BitBag\SyliusBannerPlugin\Menu;

use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;

final class AdminMenuListener
{
    public function buildMenu(MenuBuilderEvent $event): void
    {
        $menu = $event->getMenu();

        $newSubmenu = $menu
            ->addChild('Banners')
            ->setLabel('bitbag_sylius_banner_plugin.ui.banners')
            ->setLabelAttribute('icon', 'images outline')
        ;

        $newSubmenu
            ->addChild('ads', [
                'route' => 'bitbag_sylius_banner_plugin_admin_ad_index',
            ])
            ->setLabel('bitbag_sylius_banner_plugin.ui.ad')
            ->setLabelAttribute('icon', 'adversal')
        ;

        $newSubmenu
            ->addChild('banners', [
                'route' => 'bitbag_sylius_banner_plugin_admin_banner_index',
            ])
            ->setLabel('bitbag_sylius_banner_plugin.ui.banner')
            ->setLabelAttribute('icon', 'file image outline')
        ;

        $newSubmenu
            ->addChild('section', [
                'route' => 'bitbag_sylius_banner_plugin_admin_section_index',
            ])
            ->setLabel('bitbag_sylius_banner_plugin.ui.section')
            ->setLabelAttribute('icon', 'external alternate')
        ;
    }
}
