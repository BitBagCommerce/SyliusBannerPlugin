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
        $container->import('services_test.yaml');

        $container->extension('sylius_twig_hooks', [
            'hooks' => [
                'sylius_shop.homepage.index' => [
                    'banner' => [
                        'template' => 'shop/homepage/banner.html.twig',
                    ],
                ],
            ],
        ]);
    }
};
