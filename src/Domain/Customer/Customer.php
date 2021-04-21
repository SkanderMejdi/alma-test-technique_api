<?php

namespace App\Domain\Customer;

use Ramsey\Uuid\Nonstandard\Uuid;
use Ramsey\Uuid\UuidInterface;

final class Customer
{
    private UuidInterface $uuid;

    private string $firstname;

    private string $lastname;

    private string $email;

    private string $phone;

    private function __construct(
        UuidInterface $uuid,
        string $firstname,
        string $lastname,
        string $email,
        string $phone
    ) {
        $this->uuid = $uuid;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->phone = $phone;
    }

    public static function fromInfo(
        string $firstname,
        string $lastname,
        string $email,
        string $phone
    ) {
        return new Customer(Uuid::uuid4(), $firstname, $lastname, $email, $phone);
    }

    public function getUuid(): UuidInterface
    {
        return $this->uuid;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }
}