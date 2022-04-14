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

interface AdRepositoryInterface
{
    public function getAllActiveAdsBannersBySectionAndLocale(
        string $sectionCode,
        string $localeCode
    ): array;

    public function findActiveAdByCode(string $code): ?AdInterface;
}