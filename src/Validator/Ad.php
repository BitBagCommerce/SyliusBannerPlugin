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

final class Ad extends Constraint
{
    public string $message = 'bitbag_sylius_banner_plugin.ad.end_date';

    public function validatedBy(): string
    {
        return 'bitbag_sylius_banner_plugin_validator_ad_validator';
    }

    public function getTargets(): string
    {
        return self::CLASS_CONSTRAINT;
    }
}
