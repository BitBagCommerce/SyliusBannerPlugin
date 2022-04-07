<?php

/*
 * This file was created by developers working at BitBag
 * Do you need more information about us and what we do? Visit our https://bitbag.io website!
 * We are hiring developers from all over the world. Join us and start your new, exciting adventure and become part of us: https://bitbag.io/career
*/

declare(strict_types=1);

namespace BitBag\SyliusBannerPlugin\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Section implements SectionInterface
{
    protected ?int $id;

    protected ?string $name;

    protected ?string $code;

    protected ?int $width;

    protected ?int $height;

    /** @var Collection|BannerInterface[] */
    protected $banners;

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
}
