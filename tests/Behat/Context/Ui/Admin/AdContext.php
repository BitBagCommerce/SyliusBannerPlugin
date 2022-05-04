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
use Sylius\Behat\NotificationType;
use Tests\BitBag\SyliusBannerPlugin\Behat\Page\Admin\AdPage;

final class AdContext implements Context
{
    private AdPage $adPage;

    public function __construct(AdPage $adPage)
    {
        $this->adPage = $adPage;
    }

    /**
     * @When /^I am on new ad page$/
     */
    public function iAmOnNewAdPage()
    {
        $this->adPage->open();
    }

    /**
     * @When /^I create a new ad with data "([^"]*)" "([^"]*)" "([^"]*)" "([^"]*)" "([^"]*)" "([^"]*)"$/
     */
    public function iCreateANewAdWithData(
        string $name,
        bool $enabled,
        string $startDate,
        string $endDate,
        int $priority,
        string $code
    )
    {
        $this->adPage->setAdFormData(
            $name,
            $enabled,
            $startDate,
            $endDate,
            $priority,
            $code
        );
        $this->adPage->submitForm();
    }

    /**
     * @Then /^I should see error about not unique code$/
     */
    public function iShouldSeeErrorAboutNotUniqueCode()
    {
        $this->adPage->findFormError(NotificationType::failure());
        $this->adPage->findValidationError('Ad code must be unique');
    }

    /**
     * @Then /^I should see error about wrong date$/
     */
    public function iShouldSeeErrorAboutWrongDate()
    {
        $this->adPage->findFormError(NotificationType::failure());
        $this->adPage->findValidationError('End date must be bigger than start date');
    }

    private function convertDate(string $date): \DateTimeInterface
    {
        $timestamp = strtotime($date);
        $convertedDate = new \DateTime();
        $convertedDate->setTimestamp($timestamp);

        return $convertedDate;
    }
}
