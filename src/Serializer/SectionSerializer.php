<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * You can find more information about us on https://bitbag.io and write us
 * an email on hello@bitbag.io.
 */

declare(strict_types=1);

namespace BitBag\SyliusBannerPlugin\Serializer;

use BitBag\SyliusBannerPlugin\Command\GetAdsBanners;
use BitBag\SyliusBannerPlugin\Entity\SectionInterface;
use BitBag\SyliusBannerPlugin\Operator\BannersOperatorInterface;
use BitBag\SyliusBannerPlugin\Repository\AdRepositoryInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;

final class SectionSerializer implements
    ContextAwareNormalizerInterface,
    NormalizerAwareInterface
{
    use NormalizerAwareTrait;

    private RequestStack $requestStack;

    private AdRepositoryInterface $adRepository;

    private BannersOperatorInterface $bannersOperator;

    public function __construct(
        RequestStack $requestStack,
        AdRepositoryInterface $adRepository,
        BannersOperatorInterface $bannersOperator
    ) {
        $this->requestStack = $requestStack;
        $this->adRepository = $adRepository;
        $this->bannersOperator = $bannersOperator;
    }

    public function supportsNormalization(
        $data,
        string $format = null,
        array $context = []
    ) {
        return $data instanceof SectionInterface;
    }

    public function normalize(
        $section,
        string $format = null,
        array $context = []
    ) {
        /** @var GetAdsBanners $command */
        $command = $this->requestStack->getCurrentRequest()->get('data');
        $activeAds = $this->adRepository->findAllActiveAds();
        $banners = [];

        foreach ($activeAds as $ad) {
            $adBanners = $this->bannersOperator->operate($ad, $section->getCode(), $command->getLocaleCode());

            $banners = array_merge($banners, $this->normalizeBanner($adBanners));
        }

        return ['banners' => $banners];
    }

    private function normalizeBanner($banners): array
    {
        $newBanners = [];

        foreach ($banners as $banner) {
            $newBanners[] = [
                'path' => $banner->getPath(),
                'alt' => $banner->getAlt(),
                'link' => $banner->getLink(),
                'priority' => $banner->getPriority(),
                'filename' => $banner->getFilename(),
            ];
        }

        return $newBanners;
    }
}
