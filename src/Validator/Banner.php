<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * You can find more information about us on https://bitbag.io and write us
 * an email on hello@bitbag.io.
 */

declare(strict_types=1);

namespace BitBag\SyliusBannerPlugin\Validator;

use Symfony\Component\Validator\Constraint;

final class Banner extends Constraint
{
    public string $message = 'bitbag_sylius_banner_plugin.banner.link_http';

    public function validatedBy(): string
    {
        return 'bitbag_sylius_banner_plugin_validator_banner_validator';
    }

    public function getTargets(): string
    {
        return self::CLASS_CONSTRAINT;
    }
}
