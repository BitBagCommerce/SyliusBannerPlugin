<?php

declare(strict_types=1);

namespace BitBag\SyliusBannerPlugin\CommandHandler;

use BitBag\SyliusBannerPlugin\Command\GetAdsBanners;
use BitBag\SyliusBannerPlugin\Operator\BannersOperatorInterface;
use BitBag\SyliusBannerPlugin\Repository\AdRepositoryInterface;
use BitBag\SyliusBannerPlugin\Repository\SectionRepositoryInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class GetAdsBannersHandler implements MessageHandlerInterface
{
    private AdRepositoryInterface $adRepository;

    private SectionRepositoryInterface $sectionRepository;

    private BannersOperatorInterface $bannersOperator;

    public function __construct(
        AdRepositoryInterface $adRepository,
        SectionRepositoryInterface $sectionRepository,
        BannersOperatorInterface $bannersOperator
    ) {
        $this->adRepository = $adRepository;
        $this->sectionRepository = $sectionRepository;
        $this->bannersOperator = $bannersOperator;
    }

    public function __invoke(GetAdsBanners $command)
    {
        $section = $this->sectionRepository->findAllActiveAdsBanners($command->getSectionCode(), $command->getLocaleCode());

        return $section;
    }
}
