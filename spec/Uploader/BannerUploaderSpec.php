<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * You can find more information about us on https://bitbag.io and write us
 * an email on hello@bitbag.io.
 */

declare(strict_types=1);

namespace spec\BitBag\SyliusBannerPlugin\Uploader;

use BitBag\SyliusBannerPlugin\Entity\BannerInterface;
use BitBag\SyliusBannerPlugin\Generator\BannerPathGeneratorInterface;
use BitBag\SyliusBannerPlugin\Uploader\BannerUploader;
use BitBag\SyliusBannerPlugin\Uploader\BannerUploaderInterface;
use Gaufrette\Filesystem;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Sylius\Component\Channel\Context\ChannelContextInterface;
use Symfony\Component\HttpFoundation\File\File;

final class BannerUploaderSpec extends ObjectBehavior
{
    public function let(
        Filesystem $filesystem,
        BannerInterface $banner,
        BannerPathGeneratorInterface $bannerPathGenerator
    ): void {
        $file = new File(__FILE__);
        $banner->getFile()->willReturn($file);

        $this->beConstructedWith($filesystem,$bannerPathGenerator);
    }

    public function it_is_initializable(): void
    {
        $this->shouldHaveType(BannerUploader::class);
        $this->shouldImplement(BannerUploaderInterface::class);
    }

    public function it_removes_an_image_if_exists(Filesystem $filesystem): void
    {
        $filesystem->has('path/to/img')->willReturn(true);
        $filesystem->delete('path/to/img')->willReturn(true);

        $filesystem->has('path/to/img')->shouldBeCalled();
        $filesystem->delete('path/to/img')->shouldBeCalled();

        $this->remove('path/to/img');
    }
}
