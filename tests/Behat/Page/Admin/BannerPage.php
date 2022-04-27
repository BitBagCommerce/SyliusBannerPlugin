<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * You can find more information about us on https://bitbag.io and write us
 * an email on hello@bitbag.io.
 */

declare(strict_types=1);

namespace Tests\BitBag\SyliusBannerPlugin\Behat\Page\Admin;

use BitBag\SyliusBannerPlugin\Entity\AdInterface;
use BitBag\SyliusBannerPlugin\Entity\SectionInterface;
use FriendsOfBehat\PageObjectExtension\Page\SymfonyPage;
use Sylius\Behat\NotificationType;
use Webmozart\Assert\Assert;

class BannerPage extends SymfonyPage
{
    public function getRouteName(): string
    {
        return 'bitbag_sylius_banner_plugin_admin_banner_create';
    }

    public function setSectionData(
        string $name,
        string $code,
        int $width,
        int $height
    ): void {
        $this->getElement('section_name_field')->setValue($name);
        $this->getElement('section_code_field')->setValue($code);
        $this->getElement('section_height_field')->setValue($height);
        $this->getElement('section_width_field')->setValue($width);
    }

    public function submitForm(): void
    {
        $this->getDocument()->findButton('Create')->click();
    }

    public function findFormError(NotificationType $type): void
    {
        $errorMessage = $this->getDocument()->find('css', '.ui.icon.negative.message')->getText();

        Assert::contains($errorMessage, 'This form contains errors');
    }

    public function findValidationError(string $string): void
    {
        $this->getDocument()->find('css', 'form .sylius-validation-error')->getText($string);
    }

    public function fillGeneralInfoForm(
        SectionInterface $sectionCode,
        AdInterface $adCode,
        string $locale,
        int $priority
    ): void {
        $this->getElement('banner_locale_field')->setValue($locale);
        $this->getElement('banner_section_field')->setValue($sectionCode->getId());
        $this->getElement('banner_priority_field')->setValue($priority);
        $this->getElement('banner_ad_field')->setValue($adCode->getId());
    }

    public function fillBannerInfoForm(string $alt, string $link): void
    {
        $this->getElement('banner_alt_field')->setValue($alt);
        $this->getElement('banner_link_field')->setValue($link);
    }

    public function attachImage(string $path): void
    {
        $filesPath = $this->getParameter('files_path');
        $imageForm = $this->getElement('banner_file_field');
        $imageForm->attachFile($filesPath . $path);
    }

    public function getFilePath(): ?string
    {
        return $this->getParameter('files_path');
    }

    protected function getDefinedElements(): array
    {
        return array_merge(parent::getDefinedElements(), [
            'banner_locale_field' => '#bitbag_sylius_banner_plugin_banner_locale',
            'banner_section_field' => '#bitbag_sylius_banner_plugin_banner_section',
            'banner_priority_field' => '#bitbag_sylius_banner_plugin_banner_priority',
            'banner_ad_field' => '#bitbag_sylius_banner_plugin_banner_ads',
            'banner_file_field' => '#bitbag_sylius_banner_plugin_banner_file',
            'banner_link_field' => '#bitbag_sylius_banner_plugin_banner_link',
            'banner_alt_field' => '#bitbag_sylius_banner_plugin_banner_alt',
        ]);
    }
}
