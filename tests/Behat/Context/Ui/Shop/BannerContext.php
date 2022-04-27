<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * You can find more information about us on https://bitbag.io and write us
 * an email on hello@bitbag.io.
 */

declare(strict_types=1);

namespace Tests\BitBag\SyliusBannerPlugin\Behat\Context\Ui\Shop;

use Behat\Behat\Context\Context;
use Tests\BitBag\SyliusBannerPlugin\Behat\Page\Shop\Homepage;
use Webmozart\Assert\Assert;

class BannerContext implements Context
{
    private Homepage $homePage;

    public function __construct(Homepage $homePage)
    {
        $this->homePage = $homePage;
    }

    /**
     * @When /^I see (\d+) banners on homepage$/
     */
    public function iSeeBannersOnHomepage(int $count)
    {
        $banners = $this->homePage->getBanners();

        Assert::eq(count($banners), $count);
    }

    /**
     * @Then /^Banner "([^"]*)" should be (\d+) in order$/
     */
    public function bannerShouldBeInOrder(string $path, int $order)
    {
        $banners = $this->homePage->getBanners();

        Assert::true(str_contains($banners[$order - 1]->getOuterHtml(), $path));
        Assert::eq((int) $banners[$order - 1]->getAttribute('data-order'), $order);
    }
}
