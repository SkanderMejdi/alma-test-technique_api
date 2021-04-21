<?php

namespace App\Domain\Payment;

use App\Domain\Basket\Basket;
use App\Domain\Customer\Customer;

interface PaymentMethod
{
    public function getPossibleInstallment(int $basketAmount, array $installmentCounts): array;

    public function createPayment(Basket $basket, Customer $customer, int $chosenInstallmentCount): array;
}