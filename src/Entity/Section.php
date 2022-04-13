<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * You can find more information about us on https://bitbag.io and write us
 * an email on hello@bitbag.io.
 */

declare(strict_types=1);

namespace BitBag\SyliusBannerPlugin\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Section implements SectionInterface
{
    protected ?int $id = null;

    protected ?string $name = null;

    protected ?string $code = null;

    protected ?int $width = null;

    protected ?int $height = null;

    protected Collection $banners;

    public function __construct()
    {
        $this->banners = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): void
    {
        $this->code = $code;
    }

    public function getWidth(): ?int
    {
        return $this->width;
    }

    public function setWidth(?int $width): void
    {
        $this->width = $width;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function setHeight(?int $height): void
    {
        $this->height = $height;
    }

    public function getBanners(): Collection
    {
        return $this->banners;
    }

    public function addBanner(BannerInterface $banner): void
    {
        if (!$this->hasBanner($banner)) {
            $this->banners->add($banner);
        }
    }

    public function removeBanner(BannerInterface $banner): void
    {
        if ($this->hasBanner($banner)) {
            $this->banners->removeElement($banner);
        }
    }

    public function hasBanner(BannerInterface $banner): bool
    {
        return $this->banners->contains($banner);
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
