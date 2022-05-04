<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * You can find more information about us on https://bitbag.io and write us
 * an email on hello@bitbag.io.
 */

declare(strict_types=1);

namespace Tests\BitBag\SyliusBannerPlugin\Behat\Transformer;

use Behat\Behat\Context\Context;
use BitBag\SyliusBannerPlugin\Entity\AdInterface;
use BitBag\SyliusBannerPlugin\Repository\AdRepositoryInterface;
use Webmozart\Assert\Assert;

final class AdTransformer implements Context
{
    private AdRepositoryInterface $adRepository;

    public function __construct(AdRepositoryInterface $adRepository)
    {
        $this->adRepository = $adRepository;
    }

    /**
     * @Transform /^"([^"]+)" ad$/
     * @Transform /^ad "([^"]+)"$/
     * @Transform :ad
     */
    public function getAdByCode(string $adCode): AdInterface
    {
        /** @var AdInterface $ad */
        $ad = $this->adRepository->findOneBy(['code' => $adCode]);

        Assert::notNull(
            $ad,
            sprintf('Banner ad with code "%s" does not exist', $adCode)
        );

        return $ad;
    }
}
