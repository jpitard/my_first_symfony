<?php

/**
 * Created by PhpStorm.
 * User: wamobi8
 * Date: 13/01/17
 * Time: 11:48
 */
namespace AdminBundle\Service\Utils;

class StringService
{
    public function generateUniqId(){

        $result = bin2hex(openssl_random_pseudo_bytes(16));
        return $result;

    }
}