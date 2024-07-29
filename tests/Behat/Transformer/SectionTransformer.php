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
use BitBag\SyliusBannerPlugin\Entity\SectionInterface;
use BitBag\SyliusBannerPlugin\Repository\SectionRepositoryInterface;
use Webmozart\Assert\Assert;

final class SectionTransformer implements Context
{
    private SectionRepositoryInterface $sectionRepository;

    public function __construct(SectionRepositoryInterface $sectionRepository)
    {
        $this->sectionRepository = $sectionRepository;
    }

    /**
     * @Transform /^"([^"]+)" section$/
     * @Transform /^section "([^"]+)"$/
     * @Transform :section
     */
    public function getSectionByCode(string $sectionCode): SectionInterface
    {
        /** @var SectionInterface $section */
        $section = $this->sectionRepository->findOneBy(['code' => $sectionCode]);

        Assert::notNull(
            $section,
            sprintf('Banner section with code "%s" does not exist', $sectionCode),
        );

        return $section;
    }
}
