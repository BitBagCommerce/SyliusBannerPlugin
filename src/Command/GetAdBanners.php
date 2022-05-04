<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * You can find more information about us on https://bitbag.io and write us
 * an email on hello@bitbag.io.
 */

declare(strict_types=1);

namespace BitBag\SyliusBannerPlugin\Command;

class GetAdBanners
{
    private string $adCode;

    private string $localeCode;

    private string $sectionCode;

    public function __construct(
        string $adCode,
        string $localeCode,
        string $sectionCode
    ) {
        $this->adCode = $adCode;
        $this->localeCode = $localeCode;
        $this->sectionCode = $sectionCode;
    }

    public function getAdCode(): string
    {
        return $this->adCode;
    }

    public function setAdCode(string $adCode): void
    {
        $this->adCode = $adCode;
    }

    public function getLocaleCode(): string
    {
        return $this->localeCode;
    }

    public function setLocaleCode(string $localeCode): void
    {
        $this->localeCode = $localeCode;
    }

    public function getSectionCode(): string
    {
        return $this->sectionCode;
    }

    public function setSectionCode(string $sectionCode): void
    {
        $this->sectionCode = $sectionCode;
    }
}
