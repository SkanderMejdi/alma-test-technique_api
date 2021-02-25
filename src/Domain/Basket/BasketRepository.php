<?php

namespace App\Domain\Basket;

use Ramsey\Uuid\UuidInterface;

interface BasketRepository
{
    public function findOne(UuidInterface $uuid): ?Basket;
}
