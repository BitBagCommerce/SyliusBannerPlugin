<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * You can find more information about us on https://bitbag.io and write us
 * an email on hello@bitbag.io.
 */

declare(strict_types=1);

namespace Tests\BitBag\SyliusBannerPlugin\Behat\Page\Admin;

use Behat\Mink\Session;
use FriendsOfBehat\PageObjectExtension\Page\SymfonyPage;
use Sylius\Behat\NotificationType;
use Sylius\Behat\Service\NotificationCheckerInterface;
use Symfony\Component\Routing\RouterInterface;
use Webmozart\Assert\Assert;

final class SectionPage extends SymfonyPage
{
    private NotificationCheckerInterface $notificationChecker;

    public function __construct(
        Session $session,
        $minkParameters,
        RouterInterface $router,
        NotificationCheckerInterface $notificationChecker
    ) {
        parent::__construct($session, $minkParameters, $router);
        $this->notificationChecker = $notificationChecker;
    }

    public function getRouteName(): string
    {
        return 'bitbag_sylius_banner_plugin_admin_section_create';
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

    public function findFormError(NotificationType $type)
    {
        $errorMessage = $this->getDocument()->find('css', '.ui.icon.negative.message')->getText();

        Assert::contains($errorMessage, 'This form contains errors');
    }

    public function findValidationError(string $string)
    {
        $this->getDocument()->find('css', 'form .sylius-validation-error')->getText($string);
    }

    protected function getDefinedElements(): array
    {
        return array_merge(parent::getDefinedElements(), [
            'section_name_field' => '#bitbag_sylius_banner_plugin_section_name',
            'section_code_field' => '#bitbag_sylius_banner_plugin_section_code',
            'section_height_field' => '#bitbag_sylius_banner_plugin_section_height',
            'section_width_field' => '#bitbag_sylius_banner_plugin_section_width',
        ]);
    }
}
