<?php

namespace Omnipay\BlueOrange\Message;

use Omnipay\Common\Exception\RuntimeException;
use Omnipay\Common\Helper;
use Omnipay\Common\Message\AbstractRequest as OmnipayAbstractRequest;
use Omnipay\Common\Message\ResponseInterface;
use Omnipay\BlueOrange\Traits\ApiCredentialsTrait;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Class AbstractRequest
 * @package Omnipay\BlueOrange\Message
 */
abstract class AbstractRequest extends OmnipayAbstractRequest
{
    use ApiCredentialsTrait;

    /**
     * @var string
     */
    private const ENDPOINT_URL = 'https://gateway.blueorangebank.com/api/v1';

    /**
     * @var string
     */
    protected $httpMethod = 'POST';

    /**
     * @inheritDoc
     */
    public function getData(): array
    {
        return [
            self::$brandIdParameterKey => $this->getBrandId()
        ];
    }

    /**
     * @return string
     */
    public function getHttpMethod(): string
    {
        return $this->httpMethod;
    }

    /**
     * @inheritDoc
     */
    public function sendData($data): ResponseInterface
    {
        $response = $this->httpClient->request(
            $this->httpMethod,
            $this->getEndpointUrl(),
            $this->getHeaders(),
            json_encode($data)
        );

        return $this->createResponse(
            $response->getBody()
                ->getContents(),
            $response->getHeaders(),
            $response->getStatusCode()
        );
    }

    /**
     * @return string
     */
    private function getEndpointUrl(): string
    {
        return sprintf(
            "%s/%s/",
            self::ENDPOINT_URL,
            $this->getEndpointMethod()
        );
    }

    /**
     * Endpoint method
     *
     * @return string
     */
    abstract public function getEndpointMethod(): string;

    /**
     * @return string[]
     */
    protected function getHeaders(): array
    {
        return [
            'Authorization' => "Bearer {$this->getSecretKey()}",
            'Content-Type' => 'application/json'
        ];
    }

    /**
     * @param string $bodyContents
     * @param array $headers
     * @param int $statusCode
     * @return ResponseInterface
     */
    abstract protected function createResponse(
        string $bodyContents,
        array $headers,
        int $statusCode
    ): ResponseInterface;

    /**
     * @param array $parameters
     * @return $this
     */
    public function initialize(array $parameters = []): AbstractRequest
    {
        if (null !== $this->response) {
            throw new RuntimeException('Request cannot be modified after it has been sent!');
        }

        if ($this->parameters === null) {
            $this->parameters = new ParameterBag();
        }

        Helper::initialize($this, $parameters);

        return $this;
    }
}
