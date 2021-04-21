<?php

namespace App\Tests\Behat\Basket;

use App\Domain\Basket\Basket;
use App\Domain\Customer\Customer;
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

    public function createPayment(Basket $basket, Customer $customer, int $chosenInstallmentCount): array
    {
        return [
            "id" => "47bd43628d3f4a78ab1e76f52f288f3c",
            "url" => "http://127.0.0.1:5000/pp/47bd43628d3f4a78ab1e76f52f288f3c",
            "purchase_amount" => 12000,
            "installments_count" => 3,
            "return_url" => "fake-url.com",
            "state" => "not_started",
            "installments" => [
                [
                    "due_date" => 1591362744,
                    "net_amount" => 4000,
                    "customer_fee" => 1
                ],
                [
                    "due_date" => 1591362744,
                    "net_amount" => 4000,
                    "customer_fee" => 0
                ],
                [
                    "due_date" => 1591362744,
                    "net_amount" => 4000,
                    "customer_fee" => 0
                ]
            ],
            "shipping_address" => [
                "line1" => "2 rue de la Paix",
                "postal_code" => "75008",
                "city" => "Paris"
            ],
            "customer" => [
                "first_name" => "Jane",
                "last_name" => "Doe",
                "email" => "janedoe@dummy.com",
                "phone" => "+33607080900"
            ]
        ];
    }
}