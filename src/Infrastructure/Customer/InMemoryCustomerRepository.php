<?php

namespace App\Infrastructure\Customer;

use App\Domain\Customer\Customer;
use App\Domain\Customer\CustomerRepository;
use Ramsey\Uuid\UuidInterface;

final class InMemoryCustomerRepository implements CustomerRepository
{
    public function findOne(UuidInterface $uuid): ?Customer
    {
        return Customer::fromInfo('Skander', 'MEJDI', 'mejdi.skander@gmail.com', '0661995453');
    }
}