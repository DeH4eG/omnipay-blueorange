<?php

namespace Omnipay\BlueOrange\Message\Request;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Common\Message\ResponseInterface;
use Omnipay\BlueOrange\Contracts\ClientInterface;
use Omnipay\BlueOrange\Contracts\PurchaseDetailsInterface;
use Omnipay\BlueOrange\Entity\ClientEntity;
use Omnipay\BlueOrange\Entity\PurchaseDetailsEntity;
use Omnipay\BlueOrange\Message\AbstractRequest;
use Omnipay\BlueOrange\Message\Response\PurchaseResponse;

/**
 * Class PurchaseRequest
 * @package Omnipay\BlueOrange\Message\Request
 */
class PurchaseRequest extends AbstractRequest
{
    /**
     * @var string
     */
    private const ENDPOINT_METHOD = 'purchases';

    /**
     * @var string[]
     */
    private const VALIDATE_PARAMETERS = [
        self::PARAMETER_KEY_CLIENT,
        self::PARAMETER_KEY_PURCHASE,
        self::PARAMETER_KEY_SUCCESS_REDIRECT,
        self::PARAMETER_KEY_FAILURE_REDIRECT
    ];

    /**
     * @var string
     */
    private const PARAMETER_KEY_CLIENT = 'client';

    /**
     * @var string
     */
    private const PARAMETER_KEY_PURCHASE = 'purchase';

    /**
     * @var string
     */
    private const PARAMETER_KEY_FAILURE_REDIRECT = 'failure_redirect';

    /**
     * @var string
     */
    private const PARAMETER_KEY_SUCCESS_REDIRECT = 'success_redirect';

    /**
     * @var string
     */
    private const PARAMETER_KEY_CANCEL_REDIRECT = 'cancel_redirect';

    /**
     * @inheritDoc
     */
    public function getEndpointMethod(): string
    {
        return self::ENDPOINT_METHOD;
    }

    /**
     * @return array
     * @throws InvalidRequestException
     */
    public function getData(): array
    {
        $this->validate(...self::VALIDATE_PARAMETERS);

        $purchaseData = [
            self::PARAMETER_KEY_CLIENT => $this->getClient()
                ->toArray(),
            self::PARAMETER_KEY_PURCHASE => $this->getPurchase()
                ->toArray(),
            self::PARAMETER_KEY_FAILURE_REDIRECT => $this->getFailureRedirect(),
            self::PARAMETER_KEY_SUCCESS_REDIRECT => $this->getSuccessRedirect(),
            self::PARAMETER_KEY_CANCEL_REDIRECT => $this->getCancelRedirect()
        ];

        return array_merge($purchaseData, parent::getData());
    }

    /**
     * @return ClientInterface
     */
    public function getClient(): ClientInterface
    {
        return $this->getParameter(self::PARAMETER_KEY_CLIENT);
    }

    /**
     * @return PurchaseDetailsInterface
     */
    public function getPurchase(): PurchaseDetailsInterface
    {
        return $this->getParameter(self::PARAMETER_KEY_PURCHASE);
    }

    /**
     * @return string|null
     */
    public function getFailureRedirect(): ?string
    {
        return (string)$this->getParameter(self::PARAMETER_KEY_FAILURE_REDIRECT);
    }

    /**
     * @return string|null
     */
    public function getSuccessRedirect(): ?string
    {
        return (string)$this->getParameter(self::PARAMETER_KEY_SUCCESS_REDIRECT);
    }

    /**
     * @return string|null
     */
    public function getCancelRedirect(): ?string
    {
        return (string)$this->getParameter(self::PARAMETER_KEY_CANCEL_REDIRECT);
    }

    /**
     * @param ClientInterface|array $client
     * @return self
     */
    public function setClient($client): self
    {
        if (!($client instanceof ClientInterface)) {
            $client = new ClientEntity($client);
        }

        return $this->setParameter(self::PARAMETER_KEY_CLIENT, $client);
    }

    /**
     * @param PurchaseDetailsInterface|array $purchaseDetails
     * @return self
     */
    public function setPurchase($purchaseDetails): self
    {
        if (!($purchaseDetails instanceof PurchaseDetailsInterface)) {
            $purchaseDetails = new PurchaseDetailsEntity($purchaseDetails);
        }

        return $this->setParameter(self::PARAMETER_KEY_PURCHASE, $purchaseDetails);
    }

    /**
     * @param string $successUrl
     * @return PurchaseRequest
     */
    public function setSuccessRedirect(string $successUrl): PurchaseRequest
    {
        return $this->setParameter(self::PARAMETER_KEY_SUCCESS_REDIRECT, $successUrl);
    }

    /**
     * @param string $failureUrl
     * @return PurchaseRequest
     */
    public function setFailureRedirect(string $failureUrl): PurchaseRequest
    {
        return $this->setParameter(self::PARAMETER_KEY_FAILURE_REDIRECT, $failureUrl);
    }

    /**
     * @param string $cancelUrl
     * @return PurchaseRequest
     */
    public function setCancelRedirect(string $cancelUrl): PurchaseRequest
    {
        return $this->setParameter(self::PARAMETER_KEY_CANCEL_REDIRECT, $cancelUrl);
    }

    /**
     * @param string $bodyContents
     * @param array $headers
     * @param int $statusCode
     * @return ResponseInterface
     */
    protected function createResponse(string $bodyContents, array $headers, int $statusCode): ResponseInterface
    {
        return $this->response = new PurchaseResponse($this, $bodyContents, $headers, $statusCode);
    }
}
