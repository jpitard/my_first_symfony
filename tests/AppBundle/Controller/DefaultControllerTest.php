<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/fr/');

        $container = $client->getContainer();

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        //on teste si la balise qui a l'id #container1  qui contient la balise h1 contient bien le dontenue "Welcome to Symfony "
        $this->assertContains('Welcome to Symfony', $crawler->filter('#container1 h1')->text());
       // $this->assertGreaterThan(0, $crawler->filter('h1 ul li'));

        //on teste un lien sur la page d'accueil, on cible le texte du lien
        $link = $crawler->selectLink('peinture')->link();

        //a partir du contenu recuperer on va sur un autre lien
       /* $crawler=$crawler->click($link);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('exempleTestASaisir', $crawler->filter('le selecteur du text')->text());*/

        dump($crawler);


    }
}
