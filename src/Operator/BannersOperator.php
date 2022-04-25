<?php

declare(strict_types=1);

namespace BitBag\SyliusBannerPlugin\Operator;

use BitBag\SyliusBannerPlugin\Entity\AdInterface;
use BitBag\SyliusBannerPlugin\Entity\BannerInterface;
use Doctrine\Common\Collections\Collection;

class BannersOperator implements BannersOperatorInterface
{
    public function operate(
        AdInterface $ad,
        string $sectionCode,
        string $localeCode
    ): ?array
    {
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
