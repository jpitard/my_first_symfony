<?php
/**
 * Created by PhpStorm.
 * User: wamobi8
 * Date: 13/01/17
 * Time: 14:32
 */

namespace AdminBundle\Twig;


use Doctrine\Bundle\DoctrineBundle\Registry;

class AppExtension extends \Twig_Extension
{
    private $doctrine;
    private $twig;

    public function __construct(Registry $doctrine, \Twig_Environment $twig)
    {
        $this->doctrine = $doctrine;
        $this->twig = $twig;
    }

    public function getFunctions()
    {
        return [
          new \Twig_SimpleFunction('ma_fonction', [$this, 'maFonction'])
        ];
    }

    public function maFonction(){

        $results = $this->doctrine->getRepository('AdminBundle:Category')->findAll();

        return $this->twig->render('Category/renderCategory.html.twig', [
           'categories' => $results
        ]);
       // dump($results); exit;
       // return 'OK';
    }

}