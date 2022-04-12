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
