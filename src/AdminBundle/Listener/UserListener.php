<?php
/**
 * Created by PhpStorm.
 * User: test
 * Date: 12/01/2017
 * Time: 09:49
 */

namespace AdminBundle\Listener;


use AdminBundle\Entity\User;
use AdminBundle\Service\Utils\TokenService;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;

class UserListener
{
    private $tokenService;

    /*public function __construct(TokenService $tokenService)
    {
        //$this->tokenService = $tokenService;

    }*/


    public function prePersist(User $entity, LifecycleEventArgs $args)
    {
       // $entity->setToken($this->tokenService->generateUniqId());
        //die(dump($entity));
    }

}