<?php

namespace App\Domain\Payment;

interface PaymentRepository
{
    public function save(Payment $payment): void;
}