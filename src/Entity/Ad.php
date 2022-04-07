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
use Sylius\Component\Resource\Model\ToggleableTrait;

class Ad implements AdInterface
{
    use ToggleableTrait;

    protected ?int $id;

    protected ?string $name;

    protected ?\DateTimeInterface $startAt;

    protected ?\DateTimeInterface $endAt;

    protected ?int $priority;

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

    public function getStartAt(): ?\DateTimeInterface
    {
        return $this->startAt;
    }

    public function setStartAt(?\DateTimeInterface $startAt): void
    {
        $this->startAt = $startAt;
    }

    public function getEndAt(): ?\DateTimeInterface
    {
        return $this->endAt;
    }

    public function setEndAt(?\DateTimeInterface $endAt): void
    {
        $this->endAt = $endAt;
    }

    public function getPriority(): ?int
    {
        return $this->priority;
    }

    public function setPriority(?int $priority): void
    {
        $this->priority = $priority;
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
