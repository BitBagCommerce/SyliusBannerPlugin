<?php

declare(strict_types=1);

namespace BitBag\SyliusBannerPlugin\Serializer;

use BitBag\SyliusBannerPlugin\Entity\BannerInterface;

interface BannerSerializerInterface
{
    public function normalizeBanner(BannerInterface $banner);

    public function normalizeBanners(array $banners): array;
}
