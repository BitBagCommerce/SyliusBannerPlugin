<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * You can find more information about us on https://bitbag.io and write us
 * an email on hello@bitbag.io.
 */

declare(strict_types=1);

namespace BitBag\SyliusBannerPlugin\Twig\Extension;

use BitBag\SyliusBannerPlugin\Provider\BannersProviderInterface;
use BitBag\SyliusBannerPlugin\Repository\AdRepositoryInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class BannerExtension extends AbstractExtension
{
    private AdRepositoryInterface $adRepository;

    private BannersProviderInterface $bannersProvider;

    public function __construct(AdRepositoryInterface $adRepository, BannersProviderInterface $bannersProvider)
    {
        $this->adRepository = $adRepository;
        $this->bannersProvider = $bannersProvider;
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
        string $localeCode,
    ): ?array {
        $ads = $this->adRepository->findAllActiveAds();

        if (0 === count($ads)) {
            return null;
        }

        return $this->bannersProvider->getAdsBanners($ads, $sectionCode, $localeCode);
    }

    public function getActiveAdBannersByCodeSectionAndLocale(
        string $adCode,
        string $sectionCode,
        string $localeCode,
    ): ?array {
        $ad = $this->adRepository->findActiveAdByCode($adCode);

        if (null === $ad) {
            return null;
        }

        return $this->bannersProvider->getAdBanners($ad, $sectionCode, $localeCode);
    }
}
