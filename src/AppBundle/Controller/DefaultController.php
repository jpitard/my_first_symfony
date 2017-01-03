<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', ['base_dir'=> realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
            'name' => 'johnny'

        ]);

    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contactAction(Request $request)
    {
        $nom = 'Doe';
        $prenom ='John';
        $age = 51;

        //dump($age);
        //die();
        // replace this example code with whatever you need
        return $this->render('default/contact.html.twig', ['base_dir'=> realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
            'nom' => $nom, 'prenom' => $prenom, 'age' => $age
        ]);
    }


    /**
     * @Route("/bloc_mere", name="bloc_mere")
     */
    public function bloc_mereAction(Request $request)
    {

        return $this->render('default/bloc-mere.html.twig', ['base_dir'=> realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR
            
        ]);
    }

    /**
     * @Route("/bloc_fille", name="bloc_fille")
     */
    public function bloc_filleAction(Request $request)
    {
        
        return $this->render('default/bloc-fille.html.twig', ['base_dir'=> realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR
           
        ]);
    }
}
