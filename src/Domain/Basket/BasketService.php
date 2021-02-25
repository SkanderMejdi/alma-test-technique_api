<?php

namespace App\Domain\Basket;

use App\Domain\Payment\PaymentMethod;

final class BasketService
{
    public PaymentMethod $paymentMethod;

    public function __construct(PaymentMethod $paymentMethod)
    {
        $this->paymentMethod = $paymentMethod;
    }

    public function isEligibleForMultiplePayment(Basket $basket, array $wantedInstallmentCounts = [3]): bool
    {
        $possibleInstallment = $this->paymentMethod->getPossibleInstallment(
            $basket->getAmount(),
            $wantedInstallmentCounts
        );

        return $possibleInstallment[0]['eligible'];
    }
}