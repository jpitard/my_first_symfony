<?php
/**
 * Created by PhpStorm.
 * User: wamobi8
 * Date: 13/01/17
 * Time: 14:18
 */

namespace tests\AdminBundle\Service;


use AdminBundle\Service\UnlinkService;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UnlinkServiceTest extends WebTestCase
{

    /*private $uploadDir;

    public function __construct($uploadDir){
        $this->uploadDir = $uploadDir;
    }*/

    public function testRemove(){
        //$container = $this->createClient()->getContainer();
        //$uploadDir = $container->getParameter('upload_dir');



        $uploadDir= 'tests/';
        $file = 'tempFile.txt';

        $unlinkService = new UnlinkService($uploadDir);

        file_put_contents($uploadDir.$file, 'content');
        $this->assertTrue(file_exists('tests/tempFile.txt'));

        $unlinkService->remove($file);

        $this->assertTrue(!file_exists($uploadDir.$file));
        $this->assertFileNotExists($uploadDir.$file);


    }

}