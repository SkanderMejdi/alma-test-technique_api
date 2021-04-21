<?php

namespace App\Domain\Customer;

use Ramsey\Uuid\UuidInterface;

interface CustomerRepository
{
    public function findOne(UuidInterface $uuid): ?Customer;
}
