<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="admin")
     */
    public function indexAction()
    {
        return $this->render('Default/index.html.twig');
    }

    /**
     * @Route("/feedback", name="feedback")
     */
    public function feedbackAction(Request $request )
    {
        $tabStatut = [
            'technique' => 'Technique',
            'design' => 'Design',
            'marketing' => 'Marketing',
            'autre' => 'Autre'
        ];

        $formFeedback = $this->createFormBuilder()
            ->add('page', UrlType::class, [
                    'constraints' =>
                        [
                            new Assert\NotBlank(['message' => 'Veuillez rentrer un email valider']),
                            new Assert\Url(['message' => 'Votre url {{ value }} doit être valide']),

                        ]
            ])
            ->add('statut', ChoiceType::class, array(
                    'choices'  => $tabStatut,
                    'constraints' =>
                        [
                            new Assert\Choice(['choices' => $tabStatut])
                        ]
                ))
            ->add('date', DateType::class,
                [
                    'years' => range( date('Y')-10, date('Y')+10 )
                ])
            ->add('firstname', TextType::class, [
                    'constraints' =>
                        [
                            new Assert\NotBlank(['message' => 'Veuillez rentrer un email valider']),
                            new Assert\Length([ 'min' => 2])

                        ]
            ])
            ->add('lastname', TextType::class, [
                    'constraints' =>
                        [
                            new Assert\NotBlank(['message' => 'Veuillez rentrer un email valider']),

                        ]
            ])
            ->add('email', EmailType::class, [
                    'constraints' =>
                        [
                            new Assert\NotBlank(['message' => 'Veuillez rentrer un email valider']),
                            new Assert\Email([
                                'message' => 'Votre email {{ value }} est faux '
                            ])
                        ]
            ])
            ->add('content', TextareaType::class, [
                    'constraints' =>
                        [
                            new Assert\NotBlank(['message' => 'Veuillez rentrer un email valider']),
                            new Assert\Length([ 'min' => 10,  'max' => 150])

                        ]
            ])
            ->getForm();

       $formFeedback->handleRequest($request);


        if ($formFeedback->isSubmitted() && $formFeedback->isValid()) {

            $data = $formFeedback->getData();



            $message = \Swift_Message::newInstance()
                ->setSubject('formulaire feedback ')
                ->setFrom($data['email'])
                ->setTo($data['statut'].'@monsupersite.com')
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
            $this->addFlash('success', 'Merci '.$data['firstname'].', votre feedback a bien été pris en compte' );

            // Redirection : Préciser le nom de la route dans la méthode 'redirectToRoute'
            return $this->redirectToRoute('feedback');
        }

        return $this->render('Partials/feedback.html.twig', [
            "formFeedback" => $formFeedback->createView()
        ]);
    }




}
