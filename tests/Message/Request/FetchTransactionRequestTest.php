<?php

namespace Omnipay\BlueOrange\Test\Message\Request;

use Omnipay\BlueOrange\Message\AbstractRequest;
use Omnipay\BlueOrange\Message\Request\FetchTransactionRequest;
use Omnipay\BlueOrange\Message\Response\FetchTransactionResponse;

class FetchTransactionRequestTest extends AbstractRequestTest
{
    /**
     * @var AbstractRequest
     */
    private $request;

    public function testValidationPasses(): AbstractRequest
    {
        $parameters = [
            'transaction_reference' => uniqid()
        ];

        $fetchTransactionRequest = $this->request->initialize($parameters);

        self::assertArrayHasKey('brand_id', $fetchTransactionRequest->getData());
        self::assertContains('purchases', $fetchTransactionRequest->getEndpointMethod());

        return $fetchTransactionRequest;
    }

    /**
     * @depends testValidationPasses
     * @param FetchTransactionRequest $fetchTransactionRequest
     */
    public function testIsHttpMethodGet(FetchTransactionRequest $fetchTransactionRequest): void
    {
        self::assertEquals('GET', $fetchTransactionRequest->getHttpMethod());
    }

    /**
     * @depends testValidationPasses
     * @param FetchTransactionRequest $fetchTransactionRequest
     */
    public function testDataInstances(FetchTransactionRequest $fetchTransactionRequest): void
    {
        self::assertInstanceOf(FetchTransactionResponse::class, $fetchTransactionRequest->send());
    }

    protected function setUp(): void
    {
        $this->request = $this->makeRequest(FetchTransactionRequest::class);
    }
}
