<?php

namespace Omnipay\BlueOrange\Contracts;

use Omnipay\BlueOrange\Contracts\Helper\ArrayableInterface;

/**
 * Interface PurchaseDetailsInterface
 * @package Omnipay\BlueOrange\Contracts
 */
interface PurchaseDetailsInterface extends ArrayableInterface
{
    /**
     * @param array|ProductBagInterface $products
     * @return mixed
     */
    public function setProducts($products);

    /**
     * @param string $language
     * @return mixed
     */
    public function setLanguage(string $language);

    /**
     * @param string $currency
     * @return mixed
     */
    public function setCurrency(string $currency);
}
