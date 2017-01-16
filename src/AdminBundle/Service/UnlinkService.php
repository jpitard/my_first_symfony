<?php
/**
 * Created by PhpStorm.
 * User: wamobi8
 * Date: 13/01/17
 * Time: 14:18
 */

namespace AdminBundle\Service;


class UnlinkService
{

    private $uploadDir;

    public function __construct($uploadDir){
        $this->uploadDir = $uploadDir;
    }

    public function remove($file){
        unlink($this->uploadDir . $file);
    }

}