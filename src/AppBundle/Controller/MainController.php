<?php

namespace AppBundle\Controller;

use AppBundle\Event\VisitContactEvent;
use AppBundle\Event\VisitEvents;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class MainController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        //$produits = $this->getProducts();
        $em = $this->getDoctrine()->getManager();
        $produits = $em->getRepository("AdminBundle:Product")
            ->findProductLimitPrice();

        $produitsCarou = $em->getRepository("AdminBundle:Product")
            ->findProductLimitCarousel();

        //die(dump($produits));

     /*   $eventDispatcher = $this->get('event_dispatcher');

        $event = new VisitContactEvent();
        $event->setIp($request->getClientIp());
        $eventDispatcher->dispatch(VisitEvents::CONTACT, $event);

        $fileCSV = file('../var/logs/contactFormLogs.csv');
        //dump($fileCSV);*/


        return $this->render('Public/Main/index.html.twig',
            [
                'produits' => $produits,
                'produitsCarou' => $produitsCarou,
                //'fileCSV' => $fileCSV
            ]);

    }


    /**
     * @Route("/disclaimer-cookies", name="disclaimer.cookies")
     *
     */
    public function disclaimerCookiesAction(Request $request)
    {

        $disclaimer = $request->get('disclaimer');
        //dump($disclaimer); exit;

        $session = $request->getSession();
        $session->set('disclaimer', $disclaimer);

        return new JsonResponse(['success'=>'ok']);


       // die(dump($session));




    }


}
