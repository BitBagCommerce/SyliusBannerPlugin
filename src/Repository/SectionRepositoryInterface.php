<?php

declare(strict_types=1);

namespace BitBag\SyliusBannerPlugin\Repository;

use BitBag\SyliusBannerPlugin\Entity\AdInterface;
use BitBag\SyliusBannerPlugin\Entity\SectionInterface;

interface SectionRepositoryInterface
{
    public function findAllActiveAdsBanners(string $sectionCode, string $localeCode): ?SectionInterface;

    public function findActiveAdByCode(string $code): ?AdInterface;
}
