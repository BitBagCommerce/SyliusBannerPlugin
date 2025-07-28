<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * You can find more information about us on https://bitbag.io and write us
 * an email on hello@bitbag.io.
 */

declare(strict_types=1);

namespace BitBag\SyliusBannerPlugin\StateProvider\Shop\Banner;

use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use BitBag\SyliusBannerPlugin\Entity\BannerInterface;
use BitBag\SyliusBannerPlugin\Provider\BannersProviderInterface;
use BitBag\SyliusBannerPlugin\Repository\AdRepositoryInterface;
use Sylius\Bundle\ApiBundle\SectionResolver\ShopApiSection;
use Sylius\Bundle\CoreBundle\SectionResolver\SectionProviderInterface;
use Webmozart\Assert\Assert;

/** @implements ProviderInterface<object> */
final class CollectionProvider implements ProviderInterface
{
    public function __construct(
        private readonly AdRepositoryInterface $adRepository,
        private readonly BannersProviderInterface $bannersProvider,
        private readonly SectionProviderInterface $sectionProvider,
    ) {
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        Assert::true(is_a($operation->getClass(), BannerInterface::class, true));
        Assert::isInstanceOf($operation, GetCollection::class);
        Assert::isInstanceOf($this->sectionProvider->getSection(), ShopApiSection::class);

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
