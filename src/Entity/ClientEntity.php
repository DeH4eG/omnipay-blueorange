<?php

namespace Omnipay\BlueOrange\Entity;

use Omnipay\Common\ParametersTrait;
use Omnipay\BlueOrange\Contracts\ClientInterface;

/**
 * Class Client
 * @package Omnipay\BlueOrange\Entity
 */
class ClientEntity implements ClientInterface
{
    use ParametersTrait;

    /**
     * Client constructor.
     * @param array $parameters
     */
    public function __construct(array $parameters)
    {
        $this->initialize($parameters);
    }

    /**
     * @param string $email
     * @return ClientEntity
     */
    public function setEmail(string $email): ClientEntity
    {
        return $this->setParameter('email', $email);
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->getParameter('email');
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->getParameters();
    }
}
