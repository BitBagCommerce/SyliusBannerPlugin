<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * You can find more information about us on https://bitbag.io and write us
 * an email on hello@bitbag.io.
 */

declare(strict_types=1);

namespace BitBag\SyliusBannerPlugin\Generator;

use BitBag\SyliusBannerPlugin\Entity\BannerInterface;
use Symfony\Component\HttpFoundation\File\File;

final class BannerPathGenerator implements BannerPathGeneratorInterface
{
    public function generate(BannerInterface $banner): string
    {
        /** @var File $file */
        $file = $banner->getFile();

        $hash = bin2hex(random_bytes(16));

        return $this->expandPath(
            sprintf('%s.%s', $hash, $file->guessExtension()),
            self::PATH_PREFIX,
        );
    }

    private function expandPath(string $path, string $pathPrefix): string
    {
        return sprintf(
            '/%s/%s/%s/%s',
            $pathPrefix,
            substr($path, 0, 2),
            substr($path, 2, 2),
            substr($path, 4),
        );
    }
}
