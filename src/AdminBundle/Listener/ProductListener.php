<?php
/**
 * Created by PhpStorm.
 * User: test
 * Date: 12/01/2017
 * Time: 09:49
 */

namespace AdminBundle\Listener;


use AdminBundle\Entity\Product;
use AdminBundle\Service\UnlinkService;
use AdminBundle\Service\UploadService;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;

class ProductListener
{


    private $uploadService;
    private $default_img;
    private $imageServeur;
    private $unlinkService;

    public function __construct(UploadService $AppelUploadService, $default_img_declare  )
    {
        $this->uploadService = $AppelUploadService;
        $this->default_img = $default_img_declare;
        //$this->unlinkService = $unlinkService;

    }


    public function postLoad(Product $entity, LifecycleEventArgs $args)
    {
        //dump($entity->getImage());die;
        $this->imageServeur = $entity->getImage();
        //dump($imageOrigine);die;
    }

    public function prePersist(Product $entity, LifecycleEventArgs $args)
    {
        $entity->setCreatedAT(new \DateTime());
        $entity->setUpdatedAt(new \DateTime());

        $image = $entity->getImage();
        //dump($image);die;

        if (is_null($image)) {
            $fileName = $this->default_img;
        } else {
            //if ($image!=$this->default_img){
            $fileName = $this->uploadService->upload($image);
            //}else
        }

        //$uploadService = $this->get('admin.service.upload');
        //$uploadService = $this->get('admin.service.upload');

        //$this->uploadService->upload($image);
        $entity->setImage($fileName);
    }

}