<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * You can find more information about us on https://bitbag.io and write us
 * an email on hello@bitbag.io.
 */

declare(strict_types=1);

namespace BitBag\SyliusBannerPlugin\DataProvider;

use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use BitBag\SyliusBannerPlugin\Provider\BannersProviderInterface;
use BitBag\SyliusBannerPlugin\Repository\AdRepositoryInterface;

final class GetAdsBannersDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
{
    public function __construct(
        private AdRepositoryInterface $adRepository,
        private BannersProviderInterface $bannersProvider,
        private string $class,
    ) {
    }

    public function supports(
        string $resourceClass,
        string $operationName = null,
        array $context = [],
    ): bool {
        return $this->class === $resourceClass;
    }

    public function getCollection(
        string $resourceClass,
        string $operationName = null,
        array $context = [],
    ): iterable {
        $localeCode = $context['filters']['locale_code'] ?? null;
        $sectionCode = $context['filters']['section_code'] ?? null;
        $adCode = $context['filters']['ad_code'] ?? null;

        if (null !== $localeCode && null !== $sectionCode) {
            if (null === $adCode) {
                $ads = $this->adRepository->findAllActiveAds();

                if (0 === count($ads)) {
                    return [];
                }

                $banners = $this->bannersProvider->getAdsBanners($ads, $sectionCode, $localeCode);

                return $banners ?? [];
            }

            $ad = $this->adRepository->findActiveAdByCode($adCode);

            if (null === $ad) {
                return [];
            }

            $banners = $this->bannersProvider->getAdBanners($ad, $sectionCode, $localeCode);

            return $banners ?? [];
        }

        return [];
    }
}
