<?php
/**
 * Created by PhpStorm.
 * User: wamobi8
 * Date: 23/01/17
 * Time: 12:06
 */

namespace AdminBundle\Subscriber;


use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\Event\KernelEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class KernelEventsSubscriber implements EventSubscriberInterface
{
    private $twig;
    private $session;

    /**
     * KernelEventsSubscriber constructor.
     * @param $twig
     */
    public function __construct(\Twig_Environment $twig, Session $session)
    {
        $this->twig = $twig;
        $this->session = $session;

    }


    public static function getSubscribedEvents()
    {
        // TODO: Implement getSubscribedEvents() method.
        return [
          //KernelEvents::REQUEST => 'kernelRequest'
            KernelEvents::REQUEST => 'blockCountry',
             KernelEvents::RESPONSE => 'addCookiesBlock'

        ];
    }

    public function addCookiesBlock(FilterResponseEvent $event){

        $content =  $event->getResponse()->getContent();

        //dump($this->session); exit;

        if (!$this->session->has('disclaimer')){

            $content = str_replace('<body class="hold-transition skin-blue sidebar-mini">','
                <body class="hold-transition skin-blue sidebar-mini">
                    <div class="cookies" style="margin-top: 100px; margin-left: 50px;">ce site utilise les cookies <a href="#" class="btn btn-primary"> j\'ai compris.</a>
                 </div>', $content);

        }


        $response = new Response($content);
        $event->setResponse($response);
       // die(dump($event->getResponse()));

    }

    // Fonction qui bloque l'accès du site a tous les ip d'un pays
    public function blockCountry(GetResponseEvent $event){
        //$ip = $event->getRequest()->getClientIp();
        $ip = '89.227.222.139';
        $ipService = file_get_contents("http://www.webservicex.net/geoipservice.asmx/GetGeoIP?IPAddress=$ip");
        $xml = simplexml_load_string($ipService);


        if ($xml->CountryName != 'France'){

            $view = $this->twig->render("Public/maintenance/index.html.twig");
            $response = new Response($view, 503); // pour creer la response il faut utiliser la Symfony\Component\HttpFoundation\Response;
            $event->setResponse($response); //il faut toujours retourner une response aux utilisateurs
        }

        //die(dump($xml, $xml->CountryName));
    }

    public function kernelRequest(GetResponseEvent $event){
        $request = $event->getRequest();
        $content = $event->getResponse();

        $view = $this->twig->render("Public/maintenance/index.html.twig");

        $response = new Response($view, 503); // pour creer la response il faut utiliser la Symfony\Component\HttpFoundation\Response;

        $event->setResponse($response); //il faut toujours retourner une response aux utilisateurs
       // dump('kernel request'); exit;

    }
}