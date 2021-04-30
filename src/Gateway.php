<?php

namespace Omnipay\BlueOrange;

use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Message\AbstractRequest;
use Omnipay\Common\Message\NotificationInterface;
use Omnipay\Common\Message\RequestInterface;
use Omnipay\BlueOrange\Message\Request\PurchaseRequest;
use Omnipay\BlueOrange\Message\Request\FetchTransactionRequest;
use Omnipay\BlueOrange\Traits\ApiCredentialsTrait;

/**
 * @method NotificationInterface acceptNotification(array $options = [])
 * @method RequestInterface authorize(array $options = [])
 * @method RequestInterface completeAuthorize(array $options = [])
 * @method RequestInterface capture(array $options = [])
 * @method RequestInterface purchase(array $options = [])
 * @method RequestInterface refund(array $options = [])
 * @method RequestInterface void(array $options = [])
 * @method RequestInterface createCard(array $options = [])
 * @method RequestInterface updateCard(array $options = [])
 * @method RequestInterface deleteCard(array $options = [])
 */
class Gateway extends AbstractGateway
{
    use ApiCredentialsTrait;

    /**
     * @var string
     */
    private const GATEWAY_CLASS = 'BlueOrange';

    /**
     * @var string
     */
    private const GATEWAY_NAME = 'BlueOrange gateway';

    /**
     * @return string[]
     */
    public function getDefaultParameters(): array
    {
        return [
            ApiCredentialsTrait::getBrandIdParameterKey() => '',
            ApiCredentialsTrait::getSecretKeyParameterKey() => ''
        ];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return self::GATEWAY_NAME;
    }

    /**
     * @return string
     */
    public static function getGatewayClass(): string
    {
        return self::GATEWAY_CLASS;
    }

    /**
     * @param array $options
     * @return AbstractRequest
     */
    public function completePurchase(array $options = []): AbstractRequest
    {
        return $this->createRequest(PurchaseRequest::class, $options);
    }

    /**
     * @param array $options
     * @return AbstractRequest
     */
    public function fetchTransaction(array $options = []): AbstractRequest
    {
        return $this->createRequest(FetchTransactionRequest::class, $options);
    }
}
