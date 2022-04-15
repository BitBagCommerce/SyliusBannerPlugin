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
use Gaufrette\Filesystem;
use Sylius\Component\Channel\Context\ChannelContextInterface;
use Webmozart\Assert\Assert;

final class BannerUploader implements BannerUploaderInterface
{
    private ChannelContextInterface $channelContext;

    private Filesystem $filesystem;

    public function __construct(ChannelContextInterface $channelContext, Filesystem $filesystem)
    {
        $this->channelContext = $channelContext;
        $this->filesystem = $filesystem;
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
            $hash = bin2hex(random_bytes(16));
            $path = $this->expandPath(
                sprintf('%s.%s', $hash, $file->guessExtension()),
                self::PATH_PREFIX
            );
        } while ($this->filesystem->has($path));

        $banner->setPath($path);
        $banner->setFileName($file->getFilename());

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

    private function expandPath(string $path, string $pathPrefix): string
    {
        return sprintf(
            '/%s/%s/%s/%s',
            $pathPrefix,
            substr($path, 0, 2),
            substr($path, 2, 2),
            substr($path, 4)
        );
    }

    private function has(string $path): bool
    {
        return $this->filesystem->has($path);
    }
}
