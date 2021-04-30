<?php

namespace Omnipay\BlueOrange\Test\Message\Response;

use Omnipay\Common\Message\RequestInterface;
use Omnipay\BlueOrange\Message\Response\PurchaseResponse;

class PurchaseResponseTest extends AbstractResponseTest
{
    protected const RESPONSE_CLASS_NAME = PurchaseResponse::class;

    public function testPurchaseResponseIsSuccessful(): void
    {
        $data = [
            'status' => 'created'
        ];

        $purchaseResponse = $this->getPurchaseResponse($data, [], 201);

        self::assertTrue($purchaseResponse->isSuccessful());
        self::assertEquals(201, $purchaseResponse->getCode());
    }

    private function getPurchaseResponse(array $data = [], array $headers = [], int $statusCode = 0): PurchaseResponse
    {
        $requestInterfaceMock = $this->createMock(RequestInterface::class);

        return new PurchaseResponse($requestInterfaceMock, json_encode($data), $headers, $statusCode);
    }

    public function testPurchaseResponseIsNotSuccessful(): void
    {
        $purchaseResponse = $this->getPurchaseResponse([], [], 400);

        self::assertFalse($purchaseResponse->isSuccessful());
        self::assertEquals(400, $purchaseResponse->getCode());
    }
}
