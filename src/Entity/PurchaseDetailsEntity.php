<?php

namespace Omnipay\BlueOrange\Entity;

use Omnipay\Common\ParametersTrait;
use Omnipay\BlueOrange\Common\ProductBag;
use Omnipay\BlueOrange\Contracts\ProductBagInterface;
use Omnipay\BlueOrange\Contracts\PurchaseDetailsInterface;

/**
 * Class PurchaseDetails
 * @package Omnipay\BlueOrange\Entity
 */
class PurchaseDetailsEntity implements PurchaseDetailsInterface
{
    use ParametersTrait;

    /**
     * PurchaseDetails constructor.
     * @param array $parameters
     */
    public function __construct(array $parameters)
    {
        $this->initialize($parameters);
    }

    /**
     * @param array|ProductBagInterface $products
     * @return PurchaseDetailsEntity
     */
    public function setProducts($products): PurchaseDetailsEntity
    {
        if (!($products instanceof ProductBagInterface)) {
            $products = new ProductBag($products);
        }

        return $this->setParameter('products', $products);
    }

    /**
     * @return ProductBagInterface
     */
    public function getProducts(): ProductBagInterface
    {
        return $this->getParameter('products');
    }

    /**
     * @param string $currency
     * @return PurchaseDetailsEntity
     */
    public function setCurrency(string $currency): PurchaseDetailsEntity
    {
        return $this->setParameter('currency', $currency);
    }

    /**
     * @param string $language
     * @return PurchaseDetailsEntity
     */
    public function setLanguage(string $language): PurchaseDetailsEntity
    {
        return $this->setParameter('language', $language);
    }

    /**
     * @param int $totalOverride
     * @return PurchaseDetailsEntity
     */
    public function setTotalOverride(int $totalOverride): PurchaseDetailsEntity
    {
        return $this->setParameter('total_override', $totalOverride);
    }

    /**
     * @return int|null
     */
    public function getTotalOverride(): ?int
    {
        return $this->getParameter('total_override');
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $parameters = $this->getParameters();

        foreach ($parameters as $key => $parameter) {
            if (is_object($parameter)) {
                $parameters[$key] = $parameter->toArray();
            }
        }

        return $parameters;
    }
}
