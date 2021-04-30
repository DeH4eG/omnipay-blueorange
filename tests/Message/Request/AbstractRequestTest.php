<?php

namespace Omnipay\BlueOrange\Test\Message\Request;

use Omnipay\Common\Http\ClientInterface;
use Omnipay\BlueOrange\Entity\ClientEntity;
use Omnipay\BlueOrange\Entity\PurchaseDetailsEntity;
use Omnipay\BlueOrange\Message\AbstractRequest;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

abstract class AbstractRequestTest extends TestCase
{
    protected function makeRequest(string $class): AbstractRequest
    {
        $clientMock = $this->createMock(ClientInterface::class);
        $httpRequestMock = $this->createMock(HttpRequest::class);
        $responseMock = $this->createMock(ResponseInterface::class);
        $streamLineMock = $this->createMock(StreamInterface::class);

        $streamLineMock
            ->method('getContents')
            ->willReturn('');

        $responseMock
            ->method('getBody')
            ->willReturn($streamLineMock);

        $responseMock
            ->method('getHeaders')
            ->willReturn([]);

        $responseMock
            ->method('getStatusCode')
            ->willReturn(0);

        $clientMock
            ->method('request')
            ->willReturn($responseMock);

        return (new $class($clientMock, $httpRequestMock))
            ->setBrandId(uniqid())
            ->setSecretKey(uniqid());
    }

    protected function createClientEntityMock(): ClientEntity
    {
        return $this->createMock(ClientEntity::class);
    }

    protected function createPurchaseEntityMock(): PurchaseDetailsEntity
    {
        return $this->createMock(PurchaseDetailsEntity::class);
    }
}