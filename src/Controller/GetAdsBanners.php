<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * You can find more information about us on https://bitbag.io and write us
 * an email on hello@bitbag.io.
 */

declare(strict_types=1);

namespace BitBag\SyliusBannerPlugin\Controller;

use BitBag\SyliusBannerPlugin\Command\GetAdsBanners as GetAdsBannersCommand;
use BitBag\SyliusBannerPlugin\Operator\BannersOperatorInterface;
use BitBag\SyliusBannerPlugin\Repository\AdRepositoryInterface;

final class GetAdsBanners
{
    private AdRepositoryInterface $adRepository;

    private BannersOperatorInterface $bannersOperator;

    public function __construct(
        AdRepositoryInterface $adRepository,
        BannersOperatorInterface $bannersOperator
    ) {
        $this->adRepository = $adRepository;
        $this->bannersOperator = $bannersOperator;
    }

    public function __invoke(GetAdsBannersCommand $data)
    {
        $activeAds = $this->adRepository->findAllActiveAds();
        $banners = [];

        foreach ($activeAds as $ad) {
            $adBanners = $this->bannersOperator->operate($ad, $data->getSectionCode(), $data->getLocaleCode());
            if (false === empty($adBanners)) {
                $banners = array_merge($banners, $adBanners);
            }
        }

        return $banners;
    }
}
