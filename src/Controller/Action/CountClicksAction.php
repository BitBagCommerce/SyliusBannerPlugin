<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * You can find more information about us on https://bitbag.io and write us
 * an email on hello@bitbag.io.
 */

declare(strict_types=1);

namespace BitBag\SyliusBannerPlugin\Controller\Action;

use BitBag\SyliusBannerPlugin\Entity\BannerInterface;
use BitBag\SyliusBannerPlugin\Repository\BannerRepositoryInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class CountClicksAction
{
    private BannerRepositoryInterface $bannerRepository;

    private ObjectManager $objectManager;

    public function __construct(
        BannerRepositoryInterface $bannerRepository,
        ObjectManager $objectManager,
    ) {
        $this->bannerRepository = $bannerRepository;
        $this->objectManager = $objectManager;
    }

    public function __invoke(Request $request): Response
    {
        $bannerId = $request->get('id');
        if (null === $bannerId) {
            return new Response();
        }

        $banner = $this->bannerRepository->find($bannerId);
        if (false === $banner instanceof BannerInterface) {
            return new Response();
        }

        $banner->click();
        $this->objectManager->flush();

        if (null === $banner->getLink()) {
            return new Response();
        }

        return new RedirectResponse($banner->getLink());
    }
}
