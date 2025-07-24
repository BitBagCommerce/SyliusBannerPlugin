<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * You can find more information about us on https://bitbag.io and write us
 * an email on hello@bitbag.io.
 */

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return function (ContainerConfigurator $container) {
    $env = $_ENV['APP_ENV'] ?? 'dev';

    if (str_starts_with($env, 'test')) {
        $container->import('../../../vendor/sylius/sylius/src/Sylius/Behat/Resources/config/services.xml');
        $container->import('../../../tests/Behat/Resources/services.xml');

        // workaround needed for strange "test.client.history" problem
        // see https://github.com/FriendsOfBehat/SymfonyExtension/issues/88
        $services = $container->services();
        $services->alias('Symfony\Component\BrowserKit\AbstractBrowser', 'test.client');
    }
};
