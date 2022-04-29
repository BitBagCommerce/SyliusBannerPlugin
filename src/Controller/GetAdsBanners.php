<?php

declare(strict_types=1);

namespace BitBag\SyliusBannerPlugin\Controller;

use BitBag\SyliusBannerPlugin\Command\GetAdsBanners as GetAdsBannersCommand;
use BitBag\SyliusBannerPlugin\Operator\BannersOperatorInterface;
use BitBag\SyliusBannerPlugin\Repository\AdRepositoryInterface;

class GetAdsBanners
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
