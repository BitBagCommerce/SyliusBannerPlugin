<?php

declare(strict_types=1);

namespace BitBag\SyliusBannerPlugin\Operator;

use BitBag\SyliusBannerPlugin\Entity\AdInterface;

interface BannersOperatorInterface
{
    public function operate(
        AdInterface $ad,
        string $sectionCode,
        string $localeCode
    ): ?array;
}
