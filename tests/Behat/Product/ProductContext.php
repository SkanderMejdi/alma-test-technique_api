<?php

declare(strict_types=1);

namespace App\Tests\Behat\Product;

use Behat\Behat\Context\Context;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Webmozart\Assert\Assert;
use Symfony\Component\HttpKernel\KernelInterface;

final class ProductContext implements Context
{
    const PRODUCT_LIST_PATH = '/products';

    /** @var Response|null */
    private $response;

    /** @var KernelInterface */
    private $kernel;

    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }


    /**
     * @When I want to see the list of products
     */
    public function whenIWantToSeeTheListOfProducts(): void
    {
        $this->response = $this->kernel->handle(
            Request::create(self::PRODUCT_LIST_PATH, 'GET')
        );
    }

    /**
     * @Then I see all the products
     */
    public function thenISeeAllTheProducts(): void
    {
        $decodedResponse = \json_decode($this->response->getContent());
        Assert::notEmpty($decodedResponse);
    }
}
