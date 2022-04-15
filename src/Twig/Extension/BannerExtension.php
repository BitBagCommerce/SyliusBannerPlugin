<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * You can find more information about us on https://bitbag.io and write us
 * an email on hello@bitbag.io.
 */

declare(strict_types=1);

namespace BitBag\SyliusBannerPlugin\Twig\Extension;

use BitBag\SyliusBannerPlugin\Entity\BannerInterface;
use BitBag\SyliusBannerPlugin\Repository\AdRepositoryInterface;
use Doctrine\Common\Collections\Collection;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class BannerExtension extends AbstractExtension
{
    private AdRepositoryInterface $adRepository;

    public function __construct(AdRepositoryInterface $adRepository)
    {
        $this->adRepository = $adRepository;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('getActiveAdsBanners', [$this, 'getActiveAdsBannersBySectionAndLocale',]),
            new TwigFunction('getActiveAdBanners', [$this, 'getActiveAdBannersByCodeSectionAndLocale',]),
        ];
    }

    public function getActiveAdsBannersBySectionAndLocale(
        string $sectionCode,
        string $localeCode
    ): ?array {
        $ads = $this->adRepository->findAllActiveAdsBanners($sectionCode, $localeCode);

        if (true === empty($ads)) {
            return null;
        }
        $banners = [];

        foreach ($ads as $ad) {
            /** @var Collection $adBanners */
            $adBanners = $ad->getBanners();

            if (true === $adBanners->isEmpty()) {
                continue;
            }

            $adBanners = $this->filterBannersBySectionAndLocale($adBanners, $sectionCode, $localeCode);
            $adBanners = $adBanners->getValues();

            uasort($adBanners, [$this, 'sortByPriority']);

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

        if (null === $ad) {
            return null;
        }
        /** @var Collection $adBanners */
        $adBanners = $ad->getBanners();

        if (true === $adBanners->isEmpty()) {
            return null;
        }

        $adBanners = $this->filterBannersBySectionAndLocale($adBanners, $sectionCode, $localeCode);
        $adBanners = $adBanners->getValues();

        uasort($adBanners, [$this, 'sortByPriority']);

        return $adBanners;
    }

    private function filterBannersBySectionAndLocale(
        Collection $adBanners,
        string $sectionCode,
        string $localeCode
    ): Collection {
        return $adBanners->filter(function (BannerInterface $banner) use ($sectionCode, $localeCode) {
            if ($banner->getSection()->getCode() === $sectionCode &&
                $banner->getLocale()->getCode() === $localeCode) {
                return true;
            }
        });
    }

    private function sortByPriority($firstBanner, $secondBanner)
    {
        if ($firstBanner->getPriority() === $secondBanner->getPriority()) {
            return 0;
        }

        return ($firstBanner->getPriority() < $secondBanner->getPriority()) ? 1 : -1;
    }
}
