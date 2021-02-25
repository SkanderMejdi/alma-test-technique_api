<?php

namespace App\Domain\Payment;

interface PaymentMethod
{
    public function getPossibleInstallment(int $basketAmount, array $installmentCounts): array;
}