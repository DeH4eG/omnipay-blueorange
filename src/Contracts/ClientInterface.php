<?php

namespace Omnipay\BlueOrange\Contracts;

use Omnipay\BlueOrange\Contracts\Helper\ArrayableInterface;

/**
 * Interface ClientInterface
 * @package Omnipay\BlueOrange\Contracts
 */
interface ClientInterface extends ArrayableInterface
{
    /**
     * @param string $email
     * @return mixed
     */
    public function setEmail(string $email);

    /**
     * @return string
     */
    public function getEmail(): string;
}
