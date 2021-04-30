<?php

namespace Omnipay\BlueOrange\Common;

use Omnipay\Common\ItemBag;
use Omnipay\BlueOrange\Contracts\ProductBagInterface;
use Omnipay\BlueOrange\Contracts\ProductInterface;
use Omnipay\BlueOrange\Entity\ProductEntity;

/**
 * Class ProductBag
 * @package Omnipay\BlueOrange\Entity
 */
class ProductBag extends ItemBag implements ProductBagInterface
{
    /**
     * @param array|ProductInterface $item
     */
    public function add($item): void
    {
        if ($item instanceof ProductInterface) {
            $this->items[] = $item;
        } else {
            $this->items[] = new ProductEntity($item);
        }
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $callback = static function (ProductInterface $product) {
            return $product->toArray();
        };

        return array_map($callback, $this->all());
    }
}
