<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * You can find more information about us on https://bitbag.io and write us
 * an email on hello@bitbag.io.
 */

declare(strict_types=1);

namespace spec\BitBag\SyliusBannerPlugin\EventListener;

use BitBag\SyliusBannerPlugin\Entity\BannerInterface;
use BitBag\SyliusBannerPlugin\EventListener\BannerListener;
use BitBag\SyliusBannerPlugin\Uploader\BannerUploaderInterface;
use PhpSpec\ObjectBehavior;
use Sylius\Bundle\ResourceBundle\Event\ResourceControllerEvent;
use Webmozart\Assert\InvalidArgumentException;

final class BannerListenerSpec extends ObjectBehavior
{
    public function let(BannerUploaderInterface $bannerUploader): void
    {
        $this->beConstructedWith($bannerUploader);
    }

    public function it_is_initializable(): void
    {
        $this->shouldHaveType(BannerListener::class);
    }

    public function it_does_not_upload_if_not_banner_instance(
        ResourceControllerEvent $event,
        BannerUploaderInterface $bannerUploader,
        BannerInterface $banner
    ): void {
        $event->getSubject()->willReturn(null);
        $this->shouldThrow(InvalidArgumentException::class)->during('uploadBanner', [$event]);

        $bannerUploader->upload($banner)->willThrow(new InvalidArgumentException());
    }

    public function it_uploads_banner(
        ResourceControllerEvent $event,
        BannerUploaderInterface $bannerUploader,
        BannerInterface $banner
    ): void {
        $event->getSubject()->willReturn($banner);

        $this->shouldNotThrow(InvalidArgumentException::class)->during('uploadBanner', [$event]);
        $bannerUploader->upload($banner)->shouldBeCalled();

        $this->uploadBanner($event);
    }
}
