<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * You can find more information about us on https://bitbag.io and write us
 * an email on hello@bitbag.io.
 */

declare(strict_types=1);

namespace BitBag\SyliusBannerPlugin\Validator;

use BitBag\SyliusBannerPlugin\Entity\AdInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Webmozart\Assert\Assert;

final class AdValidator extends ConstraintValidator
{
    public function validate($ad, Constraint $constraint)
    {
        Assert::isInstanceOf($ad, AdInterface::class);

        if ($ad->getEndAt() <= $ad->getStartAt()) {
            $this->context->buildViolation($constraint->message)->atPath('endAt')->addViolation();
        }
    }
}
