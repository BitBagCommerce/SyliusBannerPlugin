<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * You can find more information about us on https://bitbag.io and write us
 * an email on hello@bitbag.io.
 */

declare(strict_types=1);

namespace BitBag\SyliusBannerPlugin\Entity;

use Doctrine\Common\Collections\Collection;

interface AdInterface
{
    public function getName(): ?string;

    public function setName(?string $name): void;

    public function getStartAt(): ?\DateTimeInterface;

    public function setStartAt(?\DateTimeInterface $startAt): void;

    public function getEndAt(): ?\DateTimeInterface;

    public function setEndAt(?\DateTimeInterface $endAt): void;

    public function getPriority(): ?int;

    public function setPriority(?int $priority): void;

    public function getBanners(): Collection;

    public function addBanner(BannerInterface $banner): void;

    public function removeBanner(BannerInterface $banner): void;

    public function hasBanner(BannerInterface $banner): bool;
}
