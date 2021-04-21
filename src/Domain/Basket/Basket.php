<?php

namespace App\Domain\Basket;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class Basket
{
    private UuidInterface $uuid;

    private int $amount;

    private UuidInterface $customerId;

    private ?string $addresse;

    private ?string $postalCode;

    private ?string $city;

    private function __construct(
        UuidInterface $uuid,
        int $amount,
        UuidInterface $customerId,
        ?string $addresse,
        ?string $postalCode,
        ?string $city
    ) {
        $this->uuid = $uuid;
        $this->amount = $amount;
        $this->customerId = $customerId;
        $this->addresse = $addresse;
        $this->postalCode = $postalCode;
        $this->city = $city;
    }

    public static function fromAmount(int $amount, UuidInterface $customerId): self
    {
        return new Basket(Uuid::uuid4(), $amount, $customerId, null, null, null);
    }

    public static function fromDatabase(array $basket): self
    {
        return new Basket(
            $basket['uuid'],
            $basket['amount'],
            $basket['customer_id'],
            $basket['addresse'],
            $basket['postal_code'],
            $basket['city']
        );
    }

    public function getUuid(): UuidInterface
    {
        return $this->uuid;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getCustomerId(): UuidInterface
    {
        return $this->customerId;
    }

    public function getAddresse(): ?string
    {
        return $this->addresse;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setAddresse(?string $addresse): void
    {
        $this->addresse = $addresse;
    }

    public function setPostalCode(?string $postalCode): void
    {
        $this->postalCode = $postalCode;
    }

    public function setCity(?string $city): void
    {
        $this->city = $city;
    }

    public function setAmount(int $amount): void
    {
        $this->amount = $amount;
    }
}