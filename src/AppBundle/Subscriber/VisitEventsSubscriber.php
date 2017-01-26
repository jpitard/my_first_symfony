<?php
/**
 * Created by PhpStorm.
 * User: wamobi8
 * Date: 26/01/17
 * Time: 09:58
 */

namespace AppBundle\Subscriber;


use AppBundle\Event\VisitContactEvent;
use AppBundle\Event\VisitEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class VisitEventsSubscriber implements EventSubscriberInterface
{

    public static function getSubscribedEvents()
    {
        return[
          VisitEvents::CONTACT =>'visitContact'
        ];
        // TODO: Implement getSubscribedEvents() method.
    }

    public function visitContact(VisitContactEvent $event){
        $ip = $event->getIp();
        $date = new \DateTime();

        file_put_contents('../var/logs/contactFormLogs.csv', $ip. ';' . $date->format('d/m/Y H:i:s') . "\n", FILE_APPEND);

        //dump('OKOKOKOKOK');

    }
}