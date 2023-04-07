<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * You can find more information about us on https://bitbag.io and write us
 * an email on hello@bitbag.io.
 */

declare(strict_types=1);

namespace BitBag\SyliusBannerPlugin\Validator;

use BitBag\SyliusBannerPlugin\Entity\BannerInterface;
use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Webmozart\Assert\Assert;

final class BannerValidator extends ConstraintValidator
{
    public function validate(mixed $banner, Constraint $constraint): void
    {
        Assert::isInstanceOf($banner, BannerInterface::class);

        if (!$constraint instanceof Banner) {
            throw new UnexpectedTypeException($constraint, Banner::class);
        }

        if (null !== $banner->getLink() && 0 !== strpos($banner->getLink(), 'http')) {
            $this->context->buildViolation($constraint->message)->atPath('link')->addViolation();
        }
    }
}
