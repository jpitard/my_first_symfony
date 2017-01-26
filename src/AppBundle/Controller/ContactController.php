<?php

namespace AppBundle\Controller;


use AppBundle\Event\VisitContactEvent;
use AppBundle\Event\VisitEvents;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


class ContactController extends Controller
{


    /**
     * @Route("/contact", name="contact")
     */
    public function contactAction(Request $request)
    {
        $eventDispatcher = $this->get('event_dispatcher');

        $event = new VisitContactEvent();
        $event->setIp($request->getClientIp());
        $eventDispatcher->dispatch(VisitEvents::CONTACT, $event);

        return $this->render('default/contact.html.twig',
            [

            ]);

    }



}
