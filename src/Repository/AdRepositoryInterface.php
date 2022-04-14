<?php

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
