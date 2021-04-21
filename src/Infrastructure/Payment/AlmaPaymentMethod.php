<?php

namespace App\Infrastructure\Payment;

use App\Domain\Basket\Basket;
use App\Domain\Customer\Customer;
use App\Domain\Payment\PaymentMethod;
use GuzzleHttp\ClientInterface;

class AlmaPaymentMethod implements PaymentMethod
{
    const PAYMENT_ELIGIBLITY_PATH = '/payments/eligibility';
    const PAYMENT_CREATION_PATH = '/payments';

    private ClientInterface $almaClient;

    private string $paymentReturnUrl;

    public function __construct(ClientInterface $almaClient, string $paymentReturnUrl)
    {
        $this->almaClient = $almaClient;
        $this->paymentReturnUrl = $paymentReturnUrl;
    }

    private function contentToArray(string $response): array
    {
        for ($i = 0; $i <= 31; ++$i) {
            $response = str_replace(chr($i), "", $response);
        }
        $response = str_replace(chr(127), "", $response);
        
        if (0 === strpos(bin2hex($response), 'efbbbf')) {
            $response = substr($response, 3);
        }

        return json_decode($response, true);
    }

    public function getPossibleInstallment(int $basketAmount, array $installmentCounts): array
    {
        $response = $this->almaClient->request('POST', self::PAYMENT_ELIGIBLITY_PATH, [
            'json' => ['payment' => [
                'purchase_amount' => $basketAmount,
                'installments_counts' => $installmentCounts,
            ]
        ]]);

        return $this->contentToArray($response->getBody()->getContents());
    }

    public function createPayment(Basket $basket, Customer $customer, int $chosenInstallmentCount): array
    {
        $response = $this->almaClient->request('POST', self::PAYMENT_CREATION_PATH, [
            'json' => [
                'payment' => [
                    'purchase_amount' => $basket->getAmount(),
                    'installments_count' => $chosenInstallmentCount,
                    'return_url' => $this->paymentReturnUrl,
                    'shipping_address' => [
                        'line1' => $basket->getAddresse(),
                        'postal_code' => $basket->getPostalCode(),
                        'city' => $basket->getCity(),
                    ],
                ],
                'customer' => [
                    'first_name' => $customer->getFirstname(),
                    'last_name' => $customer->getLastname(),
                    'email' => $customer->getEmail(),
                    'phone' => $customer->getPhone(),
                ],
        ]]);

        return $this->contentToArray($response->getBody()->getContents());
    }
}