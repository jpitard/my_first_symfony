<?php

/**
 * Created by PhpStorm.
 * User: wamobi8
 * Date: 13/01/17
 * Time: 11:48
 */
namespace Tests\AdminBundle\Service\Utils;

use AdminBundle\Service\Utils\StringService;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class StringServiceTest extends webTestCase
{
    public function testGenerateUniqId(){
        $stringService = new StringService();
        $value = $stringService->generateUniqId();
        $this->assertEquals(32, strlen($value));


       // $result = bin2hex(openssl_random_pseudo_bytes(16));
       // return $result;

    }
}