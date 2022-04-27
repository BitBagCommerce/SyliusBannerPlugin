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
use Tests\BitBag\SyliusBannerPlugin\Behat\Page\Admin\SectionPage;

class SectionContext implements Context
{
    private SectionPage $sectionPage;

    public function __construct(SectionPage $sectionPage)
    {
        $this->sectionPage = $sectionPage;
    }

    /**
     * @Given /^I create a new section with data "([^"]*)" "([^"]*)" "([^"]*)" "([^"]*)"$/
     */
    public function iCreateANewSectionWithData(
        string $name,
        string $code,
        int $width,
        int $height
    )
    {
        $this->sectionPage->setSectionData($name, $code, $width, $height);
        $this->sectionPage->submitForm();
    }

    /**
     * @When /^I am on new section page$/
     */
    public function iAmOnNewSectionPage()
    {
        $this->sectionPage->open();
    }

    /**
     * @Then /^I should see error about not unique code$/
     */
    public function iShouldSeeErrorAboutNotUniqueCode()
    {
        $this->sectionPage->findFormError(NotificationType::failure());
        $this->sectionPage->findValidationError('Section code must be unique');
    }
}
