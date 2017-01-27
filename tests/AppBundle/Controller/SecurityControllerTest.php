<?php
/**
 * Created by PhpStorm.
 * User: wamobi8
 * Date: 17/01/17
 * Time: 16:24
 */

namespace Tests\AppBundle\Controller;



use AdminBundle\Entity\User;
use AdminBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class SecurityControllerTest extends WebTestCase
{

    public function testSignin( )
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/fr/signin');
        $container = $client->getContainer();

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        //on teste si la balise qui a l'id #container1  qui contient la balise h1 contient bien le dontenue "Welcome to Symfony "
        $this->assertContains('Création de compte', $crawler->filter(' h1')->text());
        // $this->assertGreaterThan(0, $crawler->filter('h1 ul li'));

        //on teste un lien sur la page d'accueil, on cible le texte du lien
        //$link = $crawler->selectLink('peinture')->link();

        $username = 'username'.time();
        $password='password'.time();
        $email = 'email'.time() .'@gmail.com';

        $form = $crawler->selectButton('signin')->form([
            'adminbundle_user[username]'=> $username,
            'adminbundle_user[password]' => $password,
            'adminbundle_user[email]' => $email

        ]);
        //dump($form);
        $crawler = $client->submit($form);

        //a partir du contenu recuperer on va sur un autre lien
        /* $crawler=$crawler->click($link);
         $this->assertEquals(200, $client->getResponse()->getStatusCode());
         $this->assertContains('exempleTestASaisir', $crawler->filter('le selecteur du text')->text());*/

        //dump($crawler);

    }





}