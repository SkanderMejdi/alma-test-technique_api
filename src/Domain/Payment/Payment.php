<?php

namespace App\Domain\Payment;

use App\Serializable;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class Payment implements Serializable
{
    private UuidInterface $uuid;

    private string $externalReference;

    private string $url;

    private string $returnUrl;

    private string $state;

    private UuidInterface $basketId;

    private function __construct(
        UuidInterface $uuid,
        string $externalReference,
        string $url,
        string $returnUrl,
        string $state,
        UuidInterface $basketId
    ) {

        $this->uuid = $uuid;
        $this->externalReference = $externalReference;
        $this->url = $url;
        $this->returnUrl = $returnUrl;
        $this->state = $state;
        $this->basketId = $basketId;
    }

    public static function fromPaymentCreation(
        array $payment,
        UuidInterface $basketId
    ): self {
        return new Payment(
            Uuid::uuid4(),
            $payment['id'],
            $payment['url'],
            $payment['return_url'],
            $payment['state'],
            $basketId
        );
    }

    public function getUuid(): UuidInterface
    {
        return $this->uuid;
    }

    public function getExternalReference(): string
    {
        return $this->externalReference;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getReturnUrl(): string
    {
        return $this->returnUrl;
    }

    public function getState(): string
    {
        return $this->state;
    }

    public function getBasketId(): UuidInterface
    {
        return $this->basketId;
    }

    public function serialize(): array
    {
        return [
            'payment' => [
                'uuid' => $this->uuid,
                'external_reference' => $this->externalReference,
                'url' => $this->url,
                'return_url' => $this->returnUrl,
                'state' => $this->state,
                'basket_id' => $this->basketId->toString(),
            ]
        ];
    }
}