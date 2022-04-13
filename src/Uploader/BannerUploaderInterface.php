<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * You can find more information about us on https://bitbag.io and write us
 * an email on hello@bitbag.io.
 */

declare(strict_types=1);

namespace BitBag\SyliusBannerPlugin\Uploader;

use BitBag\SyliusBannerPlugin\Entity\BannerInterface;

interface BannerUploaderInterface
{
    public const PATH_PREFIX = 'banner/image';

    public function upload(BannerInterface $banner): void;

    public function remove(string $path): bool;
}
