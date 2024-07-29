<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * You can find more information about us on https://bitbag.io and write us
 * an email on hello@bitbag.io.
 */

declare(strict_types=1);

namespace BitBag\SyliusBannerPlugin\Provider;

use BitBag\SyliusBannerPlugin\Entity\AdInterface;

interface BannersProviderInterface
{
    public function getAdsBanners(
        array $ads,
        string $sectionCode,
        string $localeCode,
    ): ?array;

    public function getAdBanners(
        AdInterface $ad,
        string $sectionCode,
        string $localeCode,
    ): ?array;
}
