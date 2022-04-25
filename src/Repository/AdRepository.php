<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * You can find more information about us on https://bitbag.io and write us
 * an email on hello@bitbag.io.
 */

declare(strict_types=1);

namespace BitBag\SyliusBannerPlugin\Repository;

use BitBag\SyliusBannerPlugin\Entity\AdInterface;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;

class AdRepository extends EntityRepository implements AdRepositoryInterface
{
    public function findAllActiveAds(): array
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.startAt < CURRENT_TIMESTAMP()')
            ->andWhere('a.endAt > CURRENT_TIMESTAMP()')
            ->andWhere('a.enabled = true')
            ->orderBy('a.priority', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function findActiveAdByCode(string $code): ?AdInterface
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.startAt < CURRENT_TIMESTAMP()')
            ->andWhere('a.endAt > CURRENT_TIMESTAMP()')
            ->andWhere('a.enabled = true')
            ->andWhere('a.code = :code')
            ->setParameter('code', $code)
            ->getQuery()
            ->setMaxResults(1)
            ->getOneOrNullResult();
    }
}
