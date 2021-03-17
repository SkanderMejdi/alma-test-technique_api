<?php

declare(strict_types=1);

namespace App\Tests\Behat\Basket;

use Behat\Behat\Context\Context;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Webmozart\Assert\Assert;
use Symfony\Component\HttpKernel\KernelInterface;

final class BasketContext implements Context
{
    const MULTIPLE_PAYMENT_ELIGIBILITY_PATH = '/basket/7a711f94-79f6-4422-b171-3efe73689cf2/check-multiple-payment-eligibility';
    const MULTIPLE_PAYMENT_OPTION_PATH = '/basket/7a711f94-79f6-4422-b171-3efe73689cf2/check-multiple-payment-option';

    /** @var Response|null */
    private $response;

    /** @var KernelInterface */
    private $kernel;

    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    /**
     * @When I want to check multiple payment eligibility for my basket
     */
    public function whenIWantToCheckMultiplePaymentEligibilityForMyBasket(): void
    {
        $this->response = $this->kernel->handle(
            Request::create(self::MULTIPLE_PAYMENT_ELIGIBILITY_PATH, 'GET')
        );
    }

    /**
     * @Then I know if I can pay my basket with multiple payment option
     */
    public function thenIKnowIfICanPayMyBasketWithMultiplePaymentOption(): void
    {
        $decodedResponse = \json_decode($this->response->getContent());
        Assert::notEmpty($decodedResponse);
        Assert::eq($decodedResponse->eligibility, 'ok');
    }
    
    /**
     * @When I want to check my different payment option for my basket
     */
    public function whenIWanttoCheckMyDifferentPaymentOptionForMyBasket(): void
    {
        $this->response = $this->kernel->handle(
            Request::create(self::MULTIPLE_PAYMENT_OPTION_PATH, 'GET')
        );
    }

    /**
     * @Then I see my payment option
     */
    public function thenISeeMyPaymentOption(): void
    {
        $decodedResponse = \json_decode($this->response->getContent());
        Assert::notEmpty($decodedResponse);
        Assert::count($decodedResponse, 3);
    }
}
