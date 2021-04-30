<?php

namespace Omnipay\BlueOrange\Entity;

use Omnipay\Common\ParametersTrait;
use Omnipay\BlueOrange\Contracts\ProductInterface;

/**
 * Class Product
 * @package Omnipay\BlueOrange\Entity
 */
class ProductEntity implements ProductInterface
{
    use ParametersTrait;

    /**
     * Product constructor.
     * @param array $parameters
     */
    public function __construct(array $parameters)
    {
        $this->initialize($parameters);
    }

    /**
     * @param string $name
     * @return ProductEntity
     */
    public function setName(string $name): ProductEntity
    {
        return $this->setParameter('name', $name);
    }

    /**
     * @param int $quantity
     * @return ProductEntity
     */
    public function setQuantity(int $quantity): ProductEntity
    {
        return $this->setParameter('quantity', $quantity);
    }

    /**
     * @param int $price
     * @return ProductEntity
     */
    public function setPrice(int $price): ProductEntity
    {
        return $this->setParameter('price', $price);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->getParameter('name');
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->getParameter('quantity');
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->getParameter('price');
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->getParameters();
    }
}
