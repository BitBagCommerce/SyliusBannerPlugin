<?php

declare(strict_types=1);

namespace BitBag\SyliusBannerPlugin\Controller;

use BitBag\SyliusBannerPlugin\Command\GetAdBanners as GetAdBannersCommand;
use BitBag\SyliusBannerPlugin\Operator\BannersOperatorInterface;
use BitBag\SyliusBannerPlugin\Repository\AdRepositoryInterface;

class GetAdBanners
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

    public function __invoke(GetAdBannersCommand $data)
    {
        $ad = $this->adRepository->findActiveAdByCode($data->getAdCode());

        return $this->bannersOperator->operate($ad, $data->getSectionCode(), $data->getLocaleCode());
    }
}
