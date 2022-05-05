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
use BitBag\SyliusBannerPlugin\Entity\Banner;
use BitBag\SyliusBannerPlugin\Operator\BannersOperatorInterface;
use BitBag\SyliusBannerPlugin\Repository\AdRepositoryInterface;

final class GetAdsBannersDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
{
    private AdRepositoryInterface $adRepository;

    private BannersOperatorInterface $bannersOperator;

    public function __construct(AdRepositoryInterface $adRepository, BannersOperatorInterface $bannersOperator)
    {
        $this->adRepository = $adRepository;
        $this->bannersOperator = $bannersOperator;
    }

    public function supports(
        string $resourceClass,
        string $operationName = null,
        array $context = []
    ): bool
    {
        return Banner::class === $resourceClass;
    }

    public function getCollection(
        string $resourceClass,
        string $operationName = null,
        array $context = []
    ): iterable
    {
        $localeCode = $context['filters']['locale.code'] ?? null;
        $sectionCode = $context['filters']['section.code'] ?? null;
        $adCode = $context['filters']['ad.code'] ?? null;

        if (null !== $localeCode && null !== $sectionCode) {
            if (null === $adCode) {
                $ads = $this->adRepository->findAllActiveAds();

                if (0 === count($ads)) {
                    return [];
                }
                $banners = [];

                foreach ($ads as $ad) {
                    $adBanners = $this->bannersOperator->operate($ad, $sectionCode, $localeCode);

                    if (null !== $adBanners) {
                        $banners = array_merge($banners, $adBanners);
                    }
                }

                return [] === $banners ? [] : $banners;
            }

            $ad = $this->adRepository->findActiveAdByCode($adCode);

            return null !== $ad ? $this->bannersOperator->operate($ad, $sectionCode, $localeCode) ?? [] : [];
        }

        return [];
    }
}
