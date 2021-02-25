<?php

namespace App\Infrastructure\Basket;

use App\Domain\Basket\BasketRepository;
use App\Domain\Basket\BasketService;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

final class BasketController extends AbstractController
{
    private BasketRepository $basketRepository;

    private BasketService $basketService;

    public function __construct(BasketRepository $basketRepository, BasketService $basketService)
    {
        $this->basketRepository = $basketRepository;
        $this->basketService = $basketService;
    }

    public function checkMultiplePaymentEligibility(string $uuidAsString): Response
    {
        $uuid = Uuid::fromString($uuidAsString);
        $basket = $this->basketRepository->findOne($uuid);

        return $this->json([
            'eligibility' => $this->basketService->isEligibleForMultiplePayment($basket) 
        ]);
    }
}