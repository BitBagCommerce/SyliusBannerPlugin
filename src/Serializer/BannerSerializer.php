<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * You can find more information about us on https://bitbag.io and write us
 * an email on hello@bitbag.io.
 */

declare(strict_types=1);

namespace BitBag\SyliusBannerPlugin\Serializer;

use BitBag\SyliusBannerPlugin\Command\GetAdBanners;
use BitBag\SyliusBannerPlugin\Entity\BannerInterface;
use BitBag\SyliusBannerPlugin\Repository\AdRepositoryInterface;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;

final class BannerSerializer implements
    ContextAwareNormalizerInterface,
    NormalizerAwareInterface
{
    use NormalizerAwareTrait;

    private AdRepositoryInterface $adRepository;

    public function __construct(AdRepositoryInterface $adRepository)
    {
        $this->adRepository = $adRepository;
    }

    public function supportsNormalization(
        $data,
        string $format = null,
        array $context = []
    ) {
        return $data instanceof GetAdBanners;
    }

    public function normalize(
        $object,
        string $format = null,
        array $context = []
    ) {
        $ad = $this->adRepository->findActiveAdByCode($object->getAdCode());
        $banners = $ad->getBanners();
        $adBanners = [];

        /** @var BannerInterface $banner */
        foreach ($banners as $banner) {
            if (false === in_array($banner, $adBanners, true) &&
                $banner->getLocale()->getCode() === $object->getLocaleCode() &&
                $banner->getSection()->getCode() === $object->getSectionCode()
            ) {
                $adBanners[] = $this->normalizeBanner($banner);
            }
        }
        uasort($adBanners, [$this, 'sortByPriority']);

        return $adBanners;
    }

    private function normalizeBanner(BannerInterface $banner)
    {
        return [
            'path' => $banner->getPath(),
            'alt' => $banner->getAlt(),
            'link' => $banner->getLink(),
            'priority' => $banner->getPriority(),
            'filename' => $banner->getFileName(),
        ];
    }

    private function sortByPriority($firstBanner, $secondBanner)
    {
        if ($firstBanner['priority'] === $secondBanner['priority']) {
            return 0;
        }

        return ($firstBanner['priority'] < $secondBanner['priority']) ? 1 : -1;
    }
}
