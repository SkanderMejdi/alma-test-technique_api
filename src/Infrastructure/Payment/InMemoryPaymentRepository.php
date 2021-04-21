<?php

namespace App\Infrastructure\Payment;

use App\Domain\Payment\Payment;
use App\Domain\Payment\PaymentRepository;

class InMemoryPaymentRepository implements PaymentRepository
{
    public function save(Payment $payment): void
    {
        return;
    }
}