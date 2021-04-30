<?php

namespace Omnipay\BlueOrange\Message;

use Omnipay\Common\Message\AbstractResponse as OmnipayAbstractResponse;
use Omnipay\Common\Message\RequestInterface;
use Omnipay\BlueOrange\Exception\JsonException;
use Omnipay\BlueOrange\Helper\JsonHelper;

/**
 * Class Response
 * @package Omnipay\BlueOrange\Message
 */
abstract class AbstractResponse extends OmnipayAbstractResponse
{
    /**
     * @var int
     */
    private const STATUS_CODE_OK = 200;

    /**
     * @var array
     */
    private $headers;

    /**
     * @var int
     */
    private $statusCode;

    /**
     * Response constructor.
     * @param RequestInterface $request
     * @param string $data
     * @param array $headers
     * @param int $statusCode
     */
    public function __construct(RequestInterface $request, string $data, array $headers, int $statusCode)
    {
        parent::__construct($request, $data);
        $this->headers = $headers;
        $this->statusCode = $statusCode;
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->getStatusCode();
    }

    /**
     * @return int
     */
    protected function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @return string|null
     */
    public function getMessage(): ?string
    {
        return $this->data;
    }

    /**
     * @return array
     */
    protected function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @return bool
     */
    protected function isStatusCodeOk(): bool
    {
        return $this->statusCode === self::STATUS_CODE_OK;
    }

    /**
     * @param string $key
     * @param mixed $default
     * @return mixed
     * @throws JsonException
     */
    protected function getValueFromData(string $key, $default = null)
    {
        $data = $this->getData();

        if (strpos($key, '.') === false) {
            return $data[$key] ?? $default;
        }

        foreach (explode('.', $key) as $segment) {
            if (array_key_exists($segment, $data)) {
                $data = $data[$segment];
            } else {
                return $default;
            }
        }

        return $data;
    }

    /**
     * @return array
     * @throws JsonException
     */
    public function getData(): array
    {
        return JsonHelper::decode($this->data, true);
    }
}
