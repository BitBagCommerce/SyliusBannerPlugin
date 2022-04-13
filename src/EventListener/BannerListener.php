<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * You can find more information about us on https://bitbag.io and write us
 * an email on hello@bitbag.io.
 */

declare(strict_types=1);

namespace BitBag\SyliusBannerPlugin\EventListener;

use BitBag\SyliusBannerPlugin\Entity\BannerInterface;
use BitBag\SyliusBannerPlugin\Uploader\BannerUploader;
use Sylius\Bundle\ResourceBundle\Event\ResourceControllerEvent;
use Webmozart\Assert\Assert;

final class BannerListener
{
    private BannerUploader $bannerUploader;

    public function __construct(BannerUploader $bannerUploader)
    {
        $this->bannerUploader = $bannerUploader;
    }

    public function uploadBanner(ResourceControllerEvent $event): void
    {
        $banner = $event->getSubject();

        Assert::isInstanceOf($banner, BannerInterface::class);

        $this->bannerUploader->upload($banner);
    }

    public function removeBanner(ResourceControllerEvent $event): void
    {
        $banner = $event->getSubject();

        Assert::isInstanceOf($banner, BannerInterface::class);

        if(null !== $banner->getPath()){
            $this->bannerUploader->remove($banner->getPath());
        }
    }
}
