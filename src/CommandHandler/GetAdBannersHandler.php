<?php

declare(strict_types=1);

namespace BitBag\SyliusBannerPlugin\CommandHandler;

use BitBag\SyliusBannerPlugin\Command\GetAdBanners;
use BitBag\SyliusBannerPlugin\Operator\BannersOperatorInterface;
use BitBag\SyliusBannerPlugin\Repository\BannerRepositoryInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class GetAdBannersHandler implements MessageHandlerInterface
{
    private BannerRepositoryInterface $bannerRepository;

    private BannersOperatorInterface $bannersOperator;

    public function __construct(BannerRepositoryInterface $bannerRepository, BannersOperatorInterface $bannersOperator)
    {
        $this->bannerRepository = $bannerRepository;
        $this->bannersOperator = $bannersOperator;
    }

    public function __invoke(GetAdBanners $command)
    {
        return $command;
    }
}
