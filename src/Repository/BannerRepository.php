<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * You can find more information about us on https://bitbag.io and write us
 * an email on hello@bitbag.io.
 */

declare(strict_types=1);

namespace BitBag\SyliusBannerPlugin\Repository;

use Doctrine\ORM\QueryBuilder;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;

class BannerRepository extends EntityRepository implements BannerRepositoryInterface
{
    public function createBuilder(): QueryBuilder
    {
        return $this->createQueryBuilder('b')
            ->innerJoin('b.ads','a');
    }
}
