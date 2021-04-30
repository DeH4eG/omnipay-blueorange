<?php

namespace Omnipay\BlueOrange\Test\Message\Response;

use Omnipay\BlueOrange\Exception\JsonException;
use Omnipay\BlueOrange\Message\AbstractResponse;
use PHPUnit\Framework\TestCase;

abstract class AbstractResponseTest extends TestCase
{
    protected const RESPONSE_CLASS_NAME = AbstractResponse::class;

    public function testWhenJsonExceptionThrown(): void
    {
        $purchaseResponseStub = $this->createMock(static::RESPONSE_CLASS_NAME);

        $purchaseResponseStub->method('isSuccessful')
            ->willThrowException(new JsonException);

        $this->expectException(JsonException::class);

        $purchaseResponseStub->isSuccessful();
    }
}