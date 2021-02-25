<?php

namespace App\Infrastructure\Payment;

use App\Domain\Payment\PaymentMethod;
use GuzzleHttp\ClientInterface;

class AlmaPaymentMethod implements PaymentMethod
{
    const PAYMENT_ELIGIBLITY_PATH = '/payments/eligibility';

    private ClientInterface $almaClient;

    public function __construct(ClientInterface $almaClient)
    {
        $this->almaClient = $almaClient;
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
}