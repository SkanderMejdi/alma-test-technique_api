<?php

namespace App\Tests\Behat\Basket;

use App\Domain\Payment\PaymentMethod;

class FakePaymentMethod implements PaymentMethod
{
    public function getPossibleInstallment(int $basketAmount, array $installmentCounts): array
    {
        return [
            ['eligible' => true],
        ];
    }
}