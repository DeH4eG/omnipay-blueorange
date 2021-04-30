<?php

namespace Omnipay\BlueOrange\Message\Response;

use Omnipay\BlueOrange\Exception\JsonException;
use Omnipay\BlueOrange\Message\AbstractResponse;

/**
 * Class RetrieveObjectResponse
 * @package Omnipay\BlueOrange\Message\Response
 */
class FetchTransactionResponse extends AbstractResponse
{
    /**
     * @var string
     */
    private const STATUS_PAID = 'paid';

    /**
     * @inheritDoc
     * @throws JsonException
     */
    public function isSuccessful(): bool
    {
        return $this->isStatusCodeOk() && $this->isStatusPaid();
    }

    /**
     * @return bool
     * @throws JsonException
     */
    private function isStatusPaid(): bool
    {
        return $this->getValueFromData('status') === self::STATUS_PAID;
    }

    /**
     * @return string
     * @throws JsonException
     */
    public function getLanguage(): string
    {
        return $this->getValueFromData('purchase.language');
    }
}
