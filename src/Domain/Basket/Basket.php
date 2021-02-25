<?php

namespace App\Domain\Basket;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class Basket
{
    private UuidInterface $uuid;

    private int $amount;

    private function __construct(UuidInterface $uuid, int $amount)
    {
        $this->uuid = $uuid;
        $this->amount = $amount;
    }

    public static function fromAmount(int $amount): self
    {
        return new Basket(Uuid::uuid4(), $amount);
    }

    public function getUuid(): UuidInterface
    {
        return $this->uuid;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }
}