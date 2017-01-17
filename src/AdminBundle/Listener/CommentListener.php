<?php
/**
 * Created by PhpStorm.
 * User: test
 * Date: 12/01/2017
 * Time: 09:49
 */

namespace AdminBundle\Listener;


use AdminBundle\Entity\Comment;

use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;

class CommentListener
{

    public function prePersist(Comment $entity, LifecycleEventArgs $args)
    {
        $entity->setCreateAT(new \DateTime());

    }

}