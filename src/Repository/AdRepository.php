<?php

declare(strict_types=1);

namespace BitBag\SyliusBannerPlugin\Repository;

use BitBag\SyliusBannerPlugin\Entity\AdInterface;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;

class AdRepository extends EntityRepository implements AdRepositoryInterface
{
    public function getAllActiveAdsBannersBySectionAndLocale(
        string $sectionCode,
        string $localeCode
    ): array {
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
