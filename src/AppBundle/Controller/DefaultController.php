<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
        $formContact = $this->createFormBuilder()
                            ->add('firstname', TextType::class)
                            ->add('lastname', TextType::class)
                            ->add('email', EmailType::class)
                            ->add('content', TextareaType::class)
                            ->getForm();
        // Je lie l'objet $request avec le formulaire.
        // Cela me permet de remplir le formulaire avec les informations tapées par l'utilisateur
        $formContact->handleRequest($request);

        // Je vérifie que le formulaire est bien soumis et qu'il est valide
        if ($formContact->isSubmitted() && $formContact->isValid()) {
            // Dump de $_POST
            //dump($request->request->all());

            // Dump de $_GET
            //dump($request->query->all());

            // Récupérer les informations du formulaire
            //dump($formContact->getData());

            // Récupérer une valeur précisément du formulaire
            //dump($formContact->get('firstname')->getData());

            // La technique a utilisée est d'utiliser une varabiel ex: $data et de manipuler cette variable
            $data = $formContact->getData();

            // Envoie du mail
            $message = \Swift_Message::newInstance()
                ->setSubject('Formulaire de contact')
                ->setFrom($data['email'])
                ->setTo('contact@monsupersite.com')
                ->setBody(
                    $this->renderView('emails/formulaire-contact.html.twig', ['data' => $data]),
                    'text/html'
                )
                ->addPart(
                    $this->renderView('emails/formulaire-contact.txt.twig',['data' => $data]),
                    'text/plain'
                )
            ;
            $this->get('mailer')->send($message);

            // Affichage d'un message de success
            $this->addFlash('success', 'Votre email a bien été envoyé' );

            // Redirection : Préciser le nom de la route dans la méthode 'redirectToRoute'
            return $this->redirectToRoute('contact');
        }

        return $this->render('Default/contact.html.twig', [
            "formContact" => $formContact->createView()
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
