<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * You can find more information about us on https://bitbag.io and write us
 * an email on hello@bitbag.io.
 */

declare(strict_types=1);

namespace BitBag\SyliusBannerPlugin\Twig\Extension;

use BitBag\SyliusBannerPlugin\Operator\BannersOperatorInterface;
use BitBag\SyliusBannerPlugin\Repository\AdRepositoryInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class BannerExtension extends AbstractExtension
{
    private AdRepositoryInterface $adRepository;

    private BannersOperatorInterface $bannersOperator;

    public function __construct(AdRepositoryInterface $adRepository, BannersOperatorInterface $bannersOperator)
    {
        $this->adRepository = $adRepository;
        $this->bannersOperator = $bannersOperator;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('getActiveAdsBanners', [$this, 'getActiveAdsBannersBySectionAndLocale']),
            new TwigFunction('getActiveAdBanners', [$this, 'getActiveAdBannersByCodeSectionAndLocale']),
        ];
    }

    public function getActiveAdsBannersBySectionAndLocale(
        string $sectionCode,
        string $localeCode
    ): ?array {
        $ads = $this->adRepository->findAllActiveAds();

        if (true === empty($ads)) {
            return null;
        }
        $banners = [];

        foreach ($ads as $ad) {
            $adBanners = $this->bannersOperator->operate($ad, $sectionCode, $localeCode);

            $banners = array_merge($banners, $adBanners);
        }

        return [] === $banners ? null : $banners;
    }

    public function getActiveAdBannersByCodeSectionAndLocale(
        string $adCode,
        string $sectionCode,
        string $localeCode
    ): ?array {
        $ad = $this->adRepository->findActiveAdByCode($adCode);

        return null !== $ad ? $this->bannersOperator->operate($ad, $sectionCode, $localeCode) : null;
    }
}
