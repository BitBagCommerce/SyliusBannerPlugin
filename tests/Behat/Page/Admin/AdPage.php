<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * You can find more information about us on https://bitbag.io and write us
 * an email on hello@bitbag.io.
 */

declare(strict_types=1);

namespace Tests\BitBag\SyliusBannerPlugin\Behat\Page\Admin;

use FriendsOfBehat\PageObjectExtension\Page\SymfonyPage;
use Sylius\Behat\NotificationType;
use Webmozart\Assert\Assert;

final class AdPage extends SymfonyPage
{
    public function getRouteName(): string
    {
        return 'bitbag_sylius_banner_plugin_admin_ad_create';
    }

    public function setSectionData(
        string $name,
        string $code,
        int $width,
        int $height,
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

    public function findFormError(NotificationType $type)
    {
        $errorMessage = $this->getDocument()->find('css', '.ui.icon.negative.message')->getText();

        Assert::contains($errorMessage, 'This form contains errors');
    }

    public function findValidationError(string $string)
    {
        $this->getDocument()->find('css', 'form .sylius-validation-error')->getText($string);
    }

    public function setAdFormData(
        string $name,
        bool $enabled,
        string $startDate,
        string $endDate,
        int $priority,
        string $code,
    ) {
        $this->getElement('section_name_field')->setValue($name);
        $this->getElement('section_code_field')->setValue($code);
        $this->getElement('section_enabled_field')->setValue($enabled);
        $this->getElement('section_start_at_field')->setValue($startDate);
        $this->getElement('section_end_at_field')->setValue($endDate);
        $this->getElement('section_priority_field')->setValue($priority);
    }

    protected function getDefinedElements(): array
    {
        return array_merge(parent::getDefinedElements(), [
            'section_name_field' => '#bitbag_sylius_banner_plugin_ad_name',
            'section_enabled_field' => '#bitbag_sylius_banner_plugin_ad_enabled',
            'section_start_at_field' => '#bitbag_sylius_banner_plugin_ad_startAt',
            'section_end_at_field' => '#bitbag_sylius_banner_plugin_ad_endAt',
            'section_priority_field' => '#bitbag_sylius_banner_plugin_ad_priority',
            'section_code_field' => '#bitbag_sylius_banner_plugin_ad_code',
        ]);
    }
}
