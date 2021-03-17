<?php

namespace App\Tests\Behat\Basket;

use App\Domain\Payment\PaymentMethod;

class FakePaymentMethod implements PaymentMethod
{
    public function getPossibleInstallment(int $basketAmount, array $installmentCounts): array
    {
        return [
            [
                'constraints' => [
                    'installments_count' => [
                        'maximum' => 4,
                        'minimum' => 3,
                    ],
                ],
                'eligible' => false,
                'installments_count' => 1,
            ],
            [
                'constraints' => [
                    'purchase_amount' => [
                        'maximum' => 200000,
                        'minimum' => 10000,
                    ],
                ],
                'eligible' => false,
                'installments_count' => 3,
            ],
            [
                'constraints' => [
                    'installments_count' => [
                        'maximum' => 4,
                        'minimum' => 3,
                    ],
                ],
                'eligible' => false,
                'installments_count' => 5,
            ],
        ];
    }
}