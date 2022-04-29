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
use BitBag\SyliusBannerPlugin\Uploader\BannerUploader;
use BitBag\SyliusBannerPlugin\Uploader\BannerUploaderInterface;
use Gaufrette\Filesystem;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Sylius\Component\Channel\Context\ChannelContextInterface;
use Symfony\Component\HttpFoundation\File\File;

class BannerUploaderSpec extends ObjectBehavior
{
    public function let(
        ChannelContextInterface $channelContext,
        Filesystem $filesystem,
        BannerInterface $banner
    ) {
        $file = new File(__FILE__);
        $banner->getFile()->willReturn($file);

        $this->beConstructedWith($channelContext, $filesystem);
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

        $this->remove('path/to/img');
    }

    public function it_uploads_a_banner(
        Filesystem $filesystem,
        BannerInterface $banner
    ): void {
        $banner->hasFile()->willReturn(true);
        $banner->getPath()->willReturn('foo.jpg');

        $filesystem->has('foo.jpg')->willReturn(false);

//        $imagePathGenerator->generate($image)->willReturn('image/path/image.jpg');
        $banner->setPath(Argument::type('string'));

//            $filesystem->write(Argument::any(), Argument::any())->shouldBeCalled();

        $this->upload($banner);
    }
}
