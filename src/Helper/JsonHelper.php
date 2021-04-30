<?php

namespace Omnipay\BlueOrange\Helper;

use Omnipay\BlueOrange\Exception\JsonException;

/**
 * Class JsonHelper
 * @package Omnipay\BlueOrange\Helper
 */
class JsonHelper
{
    /**
     * @param string $json
     * @param bool $assoc
     * @param int $depth
     * @param int $options
     * @return mixed
     * @throws JsonException
     */
    public static function decode(string $json, bool $assoc = false, int $depth = 512, int $options = 0)
    {
        $data = json_decode($json, $assoc, $depth, $options);
        $jsonLastError = json_last_error();

        if ($jsonLastError !== JSON_ERROR_NONE) {
            throw new JsonException(json_last_error_msg(), $jsonLastError);
        }

        return $data;
    }
}
