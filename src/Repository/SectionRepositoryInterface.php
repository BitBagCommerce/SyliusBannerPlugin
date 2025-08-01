<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * You can find more information about us on https://bitbag.io and write us
 * an email on hello@bitbag.io.
 */

declare(strict_types=1);

namespace BitBag\SyliusBannerPlugin\Repository;

use BitBag\SyliusBannerPlugin\Entity\AdInterface;
use BitBag\SyliusBannerPlugin\Entity\SectionInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;

interface SectionRepositoryInterface extends RepositoryInterface
{
    public function findAllActiveAdsBanners(string $sectionCode, string $localeCode): ?SectionInterface;

    public function findActiveAdByCode(string $code): ?AdInterface;
}
