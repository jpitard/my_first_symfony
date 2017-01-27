<?php

/**
 * Created by PhpStorm.
 * User: wamobi8
 * Date: 13/01/17
 * Time: 11:55
 */
namespace AdminBundle\Service;

use AdminBundle\Service\Utils\StringService;


class UploadService
{
    private $stringUtilsService;
    private $uploadDir;

    //bon endroit pour intégrer un bundle de filigranne sur les images téléchargées.

    public function __construct(StringService $stringUtilsService, $uploadDir){
        $this->stringUtilsService = $stringUtilsService;
        $this->uploadDir = $uploadDir;
    }

    public function upload($image){

        $fileName = $this->stringUtilsService->generateUniqId();
        $fileName = $fileName . '.' . $image->guessExtension();
        //dump($fileName);die;
        $image->move($this->uploadDir, $fileName);
        return $fileName;

    }

}