<?php

namespace Omnipay\BlueOrange\Test;

use Omnipay\BlueOrange\Gateway;
use Omnipay\BlueOrange\Message\Response\FetchTransactionResponse;
use Omnipay\BlueOrange\Message\Response\PurchaseResponse;
use Omnipay\Tests\GatewayTestCase;

class GatewayTest extends GatewayTestCase
{
    private const TRANSACTION_REFERENCE = '82dc5d62-64a3-4fc7-aceb-68d15b2061e4';

    private const LANGUAGE_LV = 'lv';

    public function testCompletePurchaseSuccess(): void
    {
        $options = [
            'client' => [
                'email' => 'test@test.com'
            ],
            'purchase' => [
                'products' => [
                    [
                        'name' => 'Product Name',
                        'price' => 150
                    ]
                ]
            ],
            'success_redirect' => 'http://www.example.lv/success/',
            'failure_redirect' => 'http://www.example.lv/failure/',
            'cancel_redirect' => 'http://www.example.lv/cancel/',
        ];

        $this->setMockHttpResponse('Response/CompletePurchaseSuccess.txt');

        $response = $this->gateway->completePurchase($options)->send();

        self::assertInstanceOf(PurchaseResponse::class, $response);
        self::assertTrue($response->isSuccessful());
        self::assertTrue($response->isRedirect());
        self::assertEquals(self::TRANSACTION_REFERENCE, $response->getTransactionReference());
    }

    public function testCompletePurchaseFailure(): void
    {
        $options = [
            'client' => [
                'email' => 'test@test.com'
            ],
            'purchase' => [
                'products' => [
                    [
                        'name' => 'Product name',
                        'price' => 1.50
                    ]
                ]
            ],
            'success_redirect' => 'http://www.example.lv/success/',
            'failure_redirect' => 'http://www.example.lv/failure/',
            'cancel_redirect' => 'http://www.example.lv/cancel/',
        ];

        $this->setMockHttpResponse('Response/CompletePurchaseFailure.txt');

        $response = $this->gateway->completePurchase($options)->send();

        self::assertInstanceOf(PurchaseResponse::class, $response);
        self::assertFalse($response->isSuccessful());
        self::assertFalse($response->isRedirect());
        self::assertNull($response->getTransactionReference());
    }

    public function testFetchTransactionSuccess(): void
    {
        $options = [
            'transaction_reference' => self::TRANSACTION_REFERENCE
        ];

        $this->setMockHttpResponse('Response/FetchTransactionSuccess.txt');

        /** @var FetchTransactionResponse $response */
        $response = $this->gateway->fetchTransaction($options)->send();

        self::assertInstanceOf(FetchTransactionResponse::class, $response);
        self::assertTrue($response->isSuccessful());
        self::assertEquals(self::LANGUAGE_LV, $response->getLanguage());
    }

    public function testFetchTransactionFailure(): void
    {
        $options = [
            'transaction_reference' => self::TRANSACTION_REFERENCE
        ];

        $this->setMockHttpResponse('Response/FetchTransactionFailure.txt');

        /** @var FetchTransactionResponse $response */
        $response = $this->gateway->fetchTransaction($options)->send();

        self::assertInstanceOf(FetchTransactionResponse::class, $response);
        self::assertFalse($response->isSuccessful());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());
    }
}