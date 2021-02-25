<?php

namespace App\Infrastructure\Basket;

use App\Domain\Basket\Basket;
use App\Domain\Basket\BasketRepository;
use Ramsey\Uuid\UuidInterface;

final class InMemoryBasketRepository implements BasketRepository
{
    public function findOne(UuidInterface $uuid): ?Basket
    {
        return Basket::fromAmount(75);
    }
}