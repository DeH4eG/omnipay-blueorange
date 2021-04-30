<?php

namespace Omnipay\BlueOrange\Traits;

/**
 * Trait ApiCredentialsTrait
 * @package Omnipay\BlueOrange\Traits
 */
trait ApiCredentialsTrait
{
    /**
     * @var string
     */
    private static $brandIdParameterKey = 'brand_id';

    /**
     * @var string
     */
    private static $secretKeyParameterKey = 'secretKey';

    /**
     * @return string
     */
    public static function getBrandIdParameterKey(): string
    {
        return self::$brandIdParameterKey;
    }

    /**
     * @return string
     */
    public static function getSecretKeyParameterKey(): string
    {
        return self::$secretKeyParameterKey;
    }

    /**
     * @param string $brandId
     * @return mixed
     */
    public function setBrandId(string $brandId)
    {
        return $this->setParameter(self::$brandIdParameterKey, $brandId);
    }

    /**
     * @param string $secretKey
     * @return mixed
     */
    public function setSecretKey(string $secretKey)
    {
        return $this->setParameter(self::$secretKeyParameterKey, $secretKey);
    }

    /**
     * @return string
     */
    public function getBrandId(): string
    {
        return $this->getParameter(self::$brandIdParameterKey);
    }

    /**
     * @return string
     */
    public function getSecretKey(): string
    {
        return $this->getParameter(self::$secretKeyParameterKey);
    }
}
