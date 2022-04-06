<?php

declare(strict_types=1);

namespace BitBag\SyliusBannerPlugin;

use Sylius\Bundle\CoreBundle\Application\SyliusPluginTrait;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class BitBagSyliusBannerPlugin extends Bundle
{
    use SyliusPluginTrait;
}
