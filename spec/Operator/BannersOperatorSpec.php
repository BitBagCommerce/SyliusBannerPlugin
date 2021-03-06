<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * You can find more information about us on https://bitbag.io and write us
 * an email on hello@bitbag.io.
 */

declare(strict_types=1);

namespace spec\BitBag\SyliusBannerPlugin\Operator;

use BitBag\SyliusBannerPlugin\Entity\AdInterface;
use BitBag\SyliusBannerPlugin\Entity\BannerInterface;
use BitBag\SyliusBannerPlugin\Entity\SectionInterface;
use BitBag\SyliusBannerPlugin\Operator\BannersOperator;
use BitBag\SyliusBannerPlugin\Operator\BannersOperatorInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use PhpSpec\ObjectBehavior;
use Sylius\Component\Locale\Model\LocaleInterface;

final class BannersOperatorSpec extends ObjectBehavior
{
    public function it_is_initializable(): void
    {
        $this->shouldHaveType(BannersOperator::class);
        $this->shouldImplement(BannersOperatorInterface::class);
    }

    public function it_should_return_null_when_ad_has_zero_banners(
        AdInterface $ad,
        Collection $banners
    ): void {
        $ad->getBanners()->willReturn($banners);
        $banners->isEmpty()->willReturn(true);

        $ad->getBanners()->shouldBecalled();
        $this->operate($ad, 'test', 'test')->shouldReturn(null);
    }

    public function it_should_sort_banners_by_banners_priority(
        AdInterface $ad,
        BannerInterface $banner1,
        BannerInterface $banner2,
        BannerInterface $banner3,
        LocaleInterface $locale,
        SectionInterface $section
    ): void {
        $adBanners = new ArrayCollection([$banner1->getWrappedObject(), $banner2->getWrappedObject(), $banner3->getWrappedObject()]);
        $ad->getBanners()->willReturn($adBanners);

        $banner1->getPriority()->willReturn(20);
        $banner2->getPriority()->willReturn(10);
        $banner3->getPriority()->willReturn(50);

        $banner1->getSection()->willReturn($section);
        $banner2->getSection()->willReturn($section);
        $banner3->getSection()->willReturn($section);

        $section->getCode()->willReturn('test');

        $banner1->getLocale()->willReturn($locale);
        $banner2->getLocale()->willReturn($locale);
        $banner3->getLocale()->willReturn($locale);

        $locale->getCode()->willReturn('en_US');

        $results = $adBanners->getValues();

        uasort($results, [$this, 'sortByPriority']);

        $this->operate($ad, 'test', 'en_US')->shouldReturn($results);
    }

    private function sortByPriority($firstBanner, $secondBanner): int
    {
        if ($firstBanner->getPriority() === $secondBanner->getPriority()) {
            return 0;
        }

        return ($firstBanner->getPriority() < $secondBanner->getPriority()) ? 1 : -1;
    }
}
