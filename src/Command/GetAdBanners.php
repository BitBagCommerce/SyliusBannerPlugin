<?php

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
    )
    {
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
