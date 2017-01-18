<?php
/**
 * Created by PhpStorm.
 * User: wamobi8
 * Date: 17/01/17
 * Time: 16:24
 */

namespace AppBundle\Controller;



use AdminBundle\Entity\User;
use AdminBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class SecurityController extends Controller
{
    /**
     *
     * @Route("/login", name="security.login")
     */
    public function loginAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('Security/login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));

    }

    /**
     *
     * @Route("/logout", name="security.logout")
     */
    public function logoutAction(Request $request)
    {


    }
    /**
     *
     * @Route("/signin", name="security.signin")
     */
    public function signinAction(Request $request)
    {
        $user = new User();

        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();
        $rcRole = $doctrine->getRepository('AdminBundle:Role');

        $formUser = $this->createForm(UserType::class, $user);
        $formUser->handleRequest($request);

        if ($formUser->isSubmitted() && $formUser->isValid()) {

            $data = $formUser->getData();

            // il faut encrypter le mot de passe avec ENCODEPASSWORD
            // CE TRAITEMENT DOIT ETRE EFFECTUER DANS UN LISTERNER
            $encoderPassword = $this->get('security.password_encoder');
            $password = $encoderPassword->encodePassword($data, $data->getPassword());
            $data->setPassword($password);

            //utiliser mon service token
            $tokenService = $this->get('admin.service.utils.token');
            $data->setToken($tokenService->generateUniqId());



            //recuperer un role pour l'attribuer a l'utilisateur
            $role = $rcRole->findOneBy([
               'name' => 'ROLE_USER'
            ]);

            $data->addRole($role);
            $data->setIsActive(false);

        //  die(dump($data));

            $em->persist($data);
            $em->flush();

           $this->addFlash('success', 'l\'utilisateur a bien été enregistré');

            //envoi mail
            $message = \Swift_Message::newInstance()
                ->setSubject('Creation de compte ')
                ->setFrom($data->getEmail())
                //->setTo($data->getEmail())
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


            return $this->redirectToRoute('security.login');
        }

        return $this->render('Security/signin.html.twig', [
            'formUser' => $formUser->createView()
        ]);
    }
    /**
     *
     * @Route("/confirm", name="security.confirm")
     */
    public function confirmAction(Request $request)
    {
        $token = $request->query->get('token');
        $email = $request->query->get('email');

        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();
        $rcUser = $doctrine->getRepository('AdminBundle:User');

        $user = $rcUser->findOneBy([
            'token' => $token,
            'email' => $email
        ]);

        if (empty($user)) {

            throw $this->createNotFoundException("Le lien d'activation n'est plus actif ");
        }

        $user->setIsActive(true);

        $em->persist($user);
        $em->flush();

        //die(dump($token, $email, $user));
        return $this->redirectToRoute('security.login');

    }

}