<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * You can find more information about us on https://bitbag.io and write us
 * an email on hello@bitbag.io.
 */

declare(strict_types=1);

namespace Tests\BitBag\SyliusBannerPlugin\Behat\Context\Ui\Admin;

use Behat\Behat\Context\Context;
use BitBag\SyliusBannerPlugin\Entity\AdInterface;
use BitBag\SyliusBannerPlugin\Entity\SectionInterface;
use Doctrine\Persistence\ObjectManager;
use Sylius\Behat\NotificationType;
use Tests\BitBag\SyliusBannerPlugin\Behat\Page\Admin\BannerPage;
use Webmozart\Assert\Assert;

final class BannerContext implements Context
{
    private BannerPage $bannerPage;

    private ObjectManager $manager;

    public function __construct(
        BannerPage $bannerPage,
        ObjectManager $manager,
    ) {
        $this->bannerPage = $bannerPage;
        $this->manager = $manager;
    }

    /**
     * @Then /^I should see error about not unique code$/
     */
    public function iShouldSeeErrorAboutNotUniqueCode()
    {
        $this->bannerPage->findFormError(NotificationType::failure());
        $this->bannerPage->findValidationError('Ad code must be unique');
    }

    /**
     * @Then /^I should see error about invalid date$/
     */
    public function iShouldSeeErrorAboutInvalidDate()
    {
        $this->bannerPage->findFormError(NotificationType::failure());
        $this->bannerPage->findValidationError('End date must be bigger than start date');
    }

    /**
     * @Given /^I am on new banner page$/
     */
    public function iAmOnNewBannerPage()
    {
        $this->bannerPage->open();
    }

    /**
     * @When /^I fill form with ("[^"]+" section), ("[^"]+" ad), "([^"]*)" and "([^"]*)" priority$/
     */
    public function iFillFormWithAndPriority(
        SectionInterface $sectionCode,
        AdInterface $adCode,
        string $locale,
        int $priority,
    ) {
        $this->bannerPage->fillGeneralInfoForm($sectionCode, $adCode, $locale, $priority);
    }

    /**
     * @Given /^I add new image "([^"]*)" and fill alt as "([^"]*)" and link as "([^"]*)"$/
     */
    public function iAddNewImageAndFillAltAsAndLinksAs(
        string $image,
        string $alt,
        string $link,
    ) {
        $this->bannerPage->fillBannerInfoForm($alt, $link);
        $this->bannerPage->attachImage($image);
    }

    /**
     * @Given /^I submit form$/
     */
    public function iSubmitForm()
    {
        $this->bannerPage->submitForm();
    }

    /**
     * @Given /^("[^"]+" ad) should has (\d+) banners$/
     */
    public function shouldHasBanners(AdInterface $ad, int $count)
    {
        $this->manager->refresh($ad);
        Assert::eq($ad->getBanners()->count(), $count);
    }

    private function convertDate(string $date): \DateTimeInterface
    {
        $timestamp = strtotime($date);
        $convertedDate = new \DateTime();
        $convertedDate->setTimestamp($timestamp);

        return $convertedDate;
    }

    private function updateImage(string $path)
    {
        $this->bannerPage->attachImage($path);
        $this->bannerPage->submitForm();
    }
}
