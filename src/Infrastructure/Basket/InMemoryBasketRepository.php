<?php

namespace App\Infrastructure\Basket;

use App\Domain\Basket\Basket;
use App\Domain\Basket\BasketRepository;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class InMemoryBasketRepository implements BasketRepository
{
    public function findOne(UuidInterface $uuid): ?Basket
    {
        return Basket::fromDatabase([
            'uuid' => Uuid::uuid4(),
            'amount' => 10000,
            'customer_id' => Uuid::uuid4(),
            'addresse' => '54 bis boulevard notre dame de la trinite',
            'postal_code' => '97400',
            'city' => 'Saint Denis',
        ]);
    }
}