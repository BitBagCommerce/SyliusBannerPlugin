<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * You can find more information about us on https://bitbag.io and write us
 * an email on hello@bitbag.io.
 */

declare(strict_types=1);

namespace BitBag\SyliusBannerPlugin\Serializer;

use BitBag\SyliusBannerPlugin\Entity\BannerInterface;

final class BannerSerializer implements BannerSerializerInterface
{
    public function normalizeBanner(BannerInterface $banner)
    {
        return [
            'path' => $banner->getPath(),
            'alt' => $banner->getAlt(),
            'link' => $banner->getLink(),
            'priority' => $banner->getPriority(),
            'filename' => $banner->getFileName(),
        ];
    }

    public function normalizeBanners(array $banners): array
    {
        $newBanners = [];

        /** @var BannerInterface $banner */
        foreach ($banners as $banner) {
            $newBanners[] = [
                'path' => $banner->getPath(),
                'alt' => $banner->getAlt(),
                'link' => $banner->getLink(),
                'priority' => $banner->getPriority(),
                'filename' => $banner->getFilename(),
            ];
        }

        return $newBanners;
    }
}
