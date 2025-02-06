<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * You can find more information about us on https://bitbag.io and write us
 * an email on hello@bitbag.io.
 */

declare(strict_types=1);

namespace BitBag\SyliusBannerPlugin\Fixture\Factory;

use BitBag\SyliusBannerPlugin\Entity\AdInterface;
use BitBag\SyliusBannerPlugin\Entity\BannerInterface;
use BitBag\SyliusBannerPlugin\Entity\SectionInterface;
use BitBag\SyliusBannerPlugin\Repository\AdRepositoryInterface;
use BitBag\SyliusBannerPlugin\Repository\BannerRepositoryInterface;
use BitBag\SyliusBannerPlugin\Repository\SectionRepositoryInterface;
use Sylius\Component\Locale\Model\LocaleInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;

final class BannerSectionFixtureFactory implements FixtureFactoryInterface
{
    public function __construct(
        private FactoryInterface $sectionFactory,
        private FactoryInterface $bannerFactory,
        private FactoryInterface $adFactory,
        private SectionRepositoryInterface $sectionRepository,
        private BannerRepositoryInterface $bannerRepository,
        private AdRepositoryInterface $adRepository,
        private RepositoryInterface $localeRepository
    ) {
    }

    public function load(array $data): void
    {
        foreach ($data as $fields) {
            /** @var SectionInterface $section */
            $section = $this->sectionFactory->createNew();

            $section->setCode($fields['code']);
            $section->setName($fields['name']);
            $section->setHeight($fields['height']);
            $section->setWidth($fields['width']);

            $this->sectionRepository->add($section);

            if (($fields['banners'] ?? false) && is_array($fields['banners'])) {
                foreach ($fields['banners'] as $bannerData) {
                    /** @var BannerInterface $banner */
                    $banner = $this->bannerFactory->createNew();

                    $banner->setPath($bannerData['path']);
                    $banner->setAlt($bannerData['alt'] ?? null);
                    $banner->setFileName($bannerData['filename']);
                    $banner->setLink($bannerData['link'] ?? null);
                    $banner->setPriority($bannerData['priority']);
                    $banner->setClicks($bannerData['clicks'] ?? 0);

                    /** @var ?LocaleInterface $locale */
                    $locale = $this->localeRepository->findOneBy(['code' => $bannerData['locale']]);

                    if (null === $locale) {
                        throw new \Exception(sprintf('Locale with code "%s" not found', $bannerData['locale']));
                    }

                    $banner->setLocale($locale);

                    $this->bannerRepository->add($banner);

                    if (isset($bannerData['ads']) && is_array($bannerData['ads'])) {
                        foreach ($bannerData['ads'] as $adData) {
                            /** @var AdInterface $ad */
                            $ad = $this->adFactory->createNew();

                            $ad->setName($adData['name']);
                            $ad->setEnabled($adData['enabled']);
                            $ad->setStartAt(new \DateTime($adData['startAt']));
                            $ad->setEndAt(new \DateTime($adData['endAt']));
                            $ad->setPriority($adData['priority']);
                            $ad->setCode($adData['code']);

                            $this->adRepository->add($ad);

                            $banner->addAds($ad);
                        }
                    }

                    $banner->setSection($section);

                    $this->bannerRepository->add($banner);
                }
            }
        }
    }
}
