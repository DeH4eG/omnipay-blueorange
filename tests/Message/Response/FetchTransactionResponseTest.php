<?php

namespace Omnipay\BlueOrange\Test\Message\Response;

use Omnipay\Common\Message\RequestInterface;
use Omnipay\BlueOrange\Message\Response\FetchTransactionResponse;

class FetchTransactionResponseTest extends AbstractResponseTest
{
    protected const RESPONSE_CLASS_NAME = FetchTransactionResponse::class;

    public function testFetchResponseIsSuccessful(): void
    {
        $data = [
            'status' => 'paid'
        ];

        $fetchTransactionResponse = $this->getFetchTransactionResponse($data, [], 200);

        self::assertTrue($fetchTransactionResponse->isSuccessful());
        self::assertEquals(200, $fetchTransactionResponse->getCode());
    }

    private function getFetchTransactionResponse(
        array $data = [],
        array $headers = [],
        int $statusCode = 0
    ): FetchTransactionResponse {
        $requestInterfaceMock = $this->createMock(RequestInterface::class);

        return new FetchTransactionResponse($requestInterfaceMock, json_encode($data), $headers, $statusCode);
    }

    public function testFetchResponseIsNotSuccessful(): void
    {
        $fetchTransactionResponse = $this->getFetchTransactionResponse([], [], 404);

        self::assertFalse($fetchTransactionResponse->isSuccessful());
        self::assertEquals(404, $fetchTransactionResponse->getCode());
    }
}
