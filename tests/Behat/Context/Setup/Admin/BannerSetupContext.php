<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * You can find more information about us on https://bitbag.io and write us
 * an email on hello@bitbag.io.
 */

declare(strict_types=1);

namespace Tests\BitBag\SyliusBannerPlugin\Behat\Context\Setup\Admin;

use Behat\Behat\Context\Context;
use BitBag\SyliusBannerPlugin\Entity\AdInterface;
use BitBag\SyliusBannerPlugin\Entity\BannerInterface;
use BitBag\SyliusBannerPlugin\Entity\SectionInterface;
use BitBag\SyliusBannerPlugin\Repository\AdRepositoryInterface;
use BitBag\SyliusBannerPlugin\Repository\BannerRepository;
use BitBag\SyliusBannerPlugin\Repository\SectionRepositoryInterface;
use Doctrine\Persistence\ObjectRepository;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Tests\BitBag\SyliusBannerPlugin\Behat\Page\Admin\BannerPage;

final class BannerSetupContext implements Context
{
    private AdRepositoryInterface $adRepository;

    private SectionRepositoryInterface $sectionRepository;

    private FactoryInterface $adFactory;

    private FactoryInterface $sectionFactory;

    private FactoryInterface $bannerFactory;

    private ObjectRepository $localeRepository;

    private BannerPage $bannerPage;

    private BannerRepository $bannerRepository;

    public function __construct(
        AdRepositoryInterface $adRepository,
        SectionRepositoryInterface $sectionRepository,
        FactoryInterface $adFactory,
        FactoryInterface $sectionFactory,
        FactoryInterface $bannerFactory,
        ObjectRepository $localeRepository,
        BannerPage $bannerPage,
        BannerRepository $bannerRepository,
    ) {
        $this->adRepository = $adRepository;
        $this->sectionRepository = $sectionRepository;
        $this->adFactory = $adFactory;
        $this->sectionFactory = $sectionFactory;
        $this->bannerFactory = $bannerFactory;
        $this->localeRepository = $localeRepository;
        $this->bannerPage = $bannerPage;
        $this->bannerRepository = $bannerRepository;
    }

    /**
     * @Given /^The store has section with code "([^"]*)"$/
     */
    public function theStoreHasSectionWithCode(string $code)
    {
        /** @var SectionInterface $section */
        $section = $this->sectionFactory->createNew();

        $section->setName('homepage');
        $section->setCode($code);
        $section->setWidth(1000);
        $section->setHeight(500);

        $this->sectionRepository->add($section);
    }

    /**
     * @Given /^The store has active ad with code "([^"]*)" and (\d+) priority and "([^"]*)" name$/
     */
    public function theStoreHasActiveAdWithCode(
        string $code,
        int $priority,
        string $name,
    ) {
        /** @var AdInterface $ad */
        $ad = $this->adFactory->createNew();

        $ad->setCode($code);
        $ad->setName($name);
        $ad->setPriority($priority);
        $ad->setEnabled(true);
        $ad->setEndAt(new \DateTime('20-10-2040'));
        $ad->setStartAt(new \DateTime('20-10-2020'));

        $this->adRepository->add($ad);
    }

    /**
     * @Given /^The store has non active ad with code "([^"]*)" and (\d+) priority and "([^"]*)" name$/
     */
    public function theStoreHasNonActiveAdWithCode(
        string $code,
        int $priority,
        string $name,
    ) {
        /** @var AdInterface $ad */
        $ad = $this->adFactory->createNew();

        $ad->setCode($code);
        $ad->setName($name);
        $ad->setPriority($priority);
        $ad->setEnabled(true);
        $ad->setEndAt(new \DateTime('20-10-2020'));
        $ad->setStartAt(new \DateTime('20-10-2010'));

        $this->adRepository->add($ad);
    }

    /**
     * @Given /^The store has banner with image "([^"]*)" alt "([^"]*)" and link "([^"]*)" in ("[^"]+" section) and ("[^"]+" ad) with priority (\d+) in the "([^"]*)" locale$/
     */
    public function theStoreHasBannerWithImageAltAndLinkInSectionAndAdWithPriorityInTheLocale(
        string $path,
        string $alt,
        string $link,
        SectionInterface $section,
        AdInterface $ad,
        int $priority,
        string $locale,
    ) {
        $locale = $this->localeRepository->findOneBy(['code' => $locale]);

        /** @var BannerInterface $banner */
        $banner = $this->bannerFactory->createNew();

        $banner->setPriority($priority);
        $banner->setAlt($alt);
        $banner->setLink($link);
        $banner->setPath($this->bannerPage->getFilePath() . $path);
        $banner->setFileName($path);
        $banner->setLocale($locale);
        $banner->setSection($section);
        $banner->addAds($ad);

        $this->bannerRepository->add($banner);
    }
}
