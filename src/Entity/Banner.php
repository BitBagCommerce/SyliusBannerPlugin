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
use Sylius\Component\Locale\Model\LocaleInterface;

class Banner implements BannerInterface
{
    protected ?int $id;

    protected ?string $path;

    protected ?string $alt;

    protected ?string $fileName;

    protected ?LocaleInterface $locale;

    protected ?SectionInterface $section;

    /** @var Collection|AdInterface[] */
    protected $ads;

    public function __construct()
    {
        $this->ads = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(?string $path): void
    {
        $this->path = $path;
    }

    public function getAlt(): ?string
    {
        return $this->alt;
    }

    public function setAlt(?string $alt): void
    {
        $this->alt = $alt;
    }

    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    public function setFileName(?string $fileName): void
    {
        $this->fileName = $fileName;
    }

    public function getLocale(): ?LocaleInterface
    {
        return $this->locale;
    }

    public function setLocale(?LocaleInterface $locale): void
    {
        $this->locale = $locale;
    }

    public function getSection(): ?SectionInterface
    {
        return $this->section;
    }

    public function setSection(?SectionInterface $section): void
    {
        $this->section = $section;
    }

    public function getAds(): Collection
    {
        return $this->ads;
    }

    public function addAds(AdInterface $ad): void
    {
        if (!$this->hasAd($ad)) {
            $this->ads->add($ad);
        }
    }

    public function removeAd(AdInterface $ad): void
    {
        if ($this->hasAd($ad)) {
            $this->ads->removeElement($ad);
        }
    }

    public function hasAd(AdInterface $ad): bool
    {
        return $this->ads->contains($ad);
    }
}
