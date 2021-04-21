<?php

namespace App\Domain\Basket;

use App\Domain\Customer\Customer;
use App\Domain\Payment\PaymentMethod;

final class BasketService
{
    private const DEFAULT_INSTALLMENT_COUNT = [1, 3, 5];

    public PaymentMethod $paymentMethod;

    public function __construct(PaymentMethod $paymentMethod)
    {
        $this->paymentMethod = $paymentMethod;
    }

    public function multiplePaymentOption(Basket $basket, ?array $wantedInstallmentCounts = null): array
    {
        return $this->paymentMethod->getPossibleInstallment(
            $basket->getAmount(),
            $wantedInstallmentCounts ?: self::DEFAULT_INSTALLMENT_COUNT
        );
    }

    public function createPayment(Basket $basket, Customer $customer, int $chosenInstallmentCount): array
    {
        return $this->paymentMethod->createPayment($basket, $customer, $chosenInstallmentCount);
    }
}