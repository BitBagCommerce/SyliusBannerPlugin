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
use BitBag\SyliusBannerPlugin\Entity\SectionInterface;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;

class SectionRepository extends EntityRepository implements SectionRepositoryInterface
{
    public function findAllActiveAdsBanners(string $sectionCode, string $localeCode): ?SectionInterface
    {
        return $this->createQueryBuilder('s')
            ->innerJoin('s.banners', 'banners')
            ->innerJoin('banners.locale', 'locale')
            ->innerJoin('banners.ads', 'ad')
            ->where('s.code = :sectionCode')
            ->addSelect('banners')
            ->addSelect('ad')
            ->andWhere('locale.code = :localeCode')
            ->andWhere('ad.startAt < CURRENT_TIMESTAMP()')
            ->andWhere('ad.endAt > CURRENT_TIMESTAMP()')
            ->andWhere('ad.enabled = true')
            ->setParameter('sectionCode', $sectionCode)
            ->setParameter('localeCode', $localeCode)
            ->orderBy('ad.priority', 'DESC')
            ->getQuery()
            ->getOneOrNullResult();
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
