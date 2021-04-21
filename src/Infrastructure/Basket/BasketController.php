<?php

namespace App\Infrastructure\Basket;

use App\Domain\Basket\BasketRepository;
use App\Domain\Basket\BasketService;
use App\Domain\Customer\CustomerRepository;
use App\Domain\Payment\Payment;
use App\Domain\Payment\PaymentRepository;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

final class BasketController extends AbstractController
{
    private BasketRepository $basketRepository;

    private BasketService $basketService;

    private CustomerRepository $customerRepository;

    private PaymentRepository $paymentRepository;

    public function __construct(
        BasketService $basketService,
        BasketRepository $basketRepository,
        CustomerRepository $customerRepository,
        PaymentRepository $paymentRepository
    ) {
        $this->basketRepository = $basketRepository;
        $this->basketService = $basketService;
        $this->customerRepository = $customerRepository;
        $this->paymentRepository = $paymentRepository;
    }

    public function checkMultiplePaymentOption(string $uuidAsString): Response
    {
        $uuid = Uuid::fromString($uuidAsString);
        $basket = $this->basketRepository->findOne($uuid);

        return $this->json(
            $this->basketService->multiplePaymentOption($basket) 
        );
    }

    public function createPayment(string $uuidAsString, int $chosenInstallmentCount): Response
    {
        $uuid = Uuid::fromString($uuidAsString);
        $basket = $this->basketRepository->findOne($uuid);
        $customer = $this->customerRepository->findOne($basket->getCustomerId());

        $receivedPayment = $this->basketService->createPayment(
            $basket,
            $customer,
            $chosenInstallmentCount
        );

        $payment = Payment::fromPaymentCreation($receivedPayment, $basket->getUuid());
        
        $this->paymentRepository->save($payment);

        return $this->json($payment->serialize());
    }
}