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
use BitBag\SyliusBannerPlugin\Operator\BannersOperatorInterface;

final class BannersProvider implements BannersProviderInterface
{
    private BannersOperatorInterface $bannersOperator;

    public function __construct(BannersOperatorInterface $bannersOperator)
    {
        $this->bannersOperator = $bannersOperator;
    }

    public function getAdsBanners(
        array $ads,
        string $sectionCode,
        string $localeCode,
    ): ?array {
        $banners = [];

        foreach ($ads as $ad) {
            $adBanners = $this->bannersOperator->operate($ad, $sectionCode, $localeCode);
            if (null !== $adBanners) {
                $banners = array_merge($banners, $adBanners);
                $banners = array_unique($banners, \SORT_REGULAR);
            }
        }

        return [] === $banners ? null : $banners;
    }

    public function getAdBanners(
        AdInterface $ad,
        string $sectionCode,
        string $localeCode,
    ): ?array {
        return $this->bannersOperator->operate($ad, $sectionCode, $localeCode);
    }
}
