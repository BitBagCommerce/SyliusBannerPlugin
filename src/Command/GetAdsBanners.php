<?php

declare(strict_types=1);

namespace BitBag\SyliusBannerPlugin\Command;

class GetAdsBanners
{
    private string $localeCode;

    private string $sectionCode;

    public function __construct(string $localeCode, string $sectionCode)
    {
        $this->localeCode = $localeCode;
        $this->sectionCode = $sectionCode;
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
