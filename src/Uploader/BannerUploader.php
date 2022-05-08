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
use BitBag\SyliusBannerPlugin\Generator\BannerPathGeneratorInterface;
use Gaufrette\Filesystem;
use Webmozart\Assert\Assert;

final class BannerUploader implements BannerUploaderInterface
{
    private Filesystem $filesystem;

    private BannerPathGeneratorInterface $bannerPathGenerator;

    public function __construct(Filesystem $filesystem, BannerPathGeneratorInterface $bannerPathGenerator)
    {
        $this->filesystem = $filesystem;
        $this->bannerPathGenerator = $bannerPathGenerator;
    }

    public function upload(BannerInterface $banner): void
    {
        if (!$banner->hasFile()) {
            return;
        }

        $file = $banner->getFile();
        Assert::notNull($file, 'File for banner is null');

        if (null !== $banner->getPath() && $this->has($banner->getPath())) {
            $this->remove($banner->getPath());
        }

        do {
            $path = $this->bannerPathGenerator->generate($banner);
        } while ($this->filesystem->has($path));

        $banner->setPath($path);
        $banner->setFileName($file->getFilename());

        /** @var string $fileContents */
        $fileContents = file_get_contents($file->getPathname());

        $this->filesystem->write(
            $path,
            $fileContents
        );
    }

    public function remove(string $path): bool
    {
        if ($this->filesystem->has($path)) {
            return $this->filesystem->delete($path);
        }

        return false;
    }

    private function has(string $path): bool
    {
        return $this->filesystem->has($path);
    }
}
