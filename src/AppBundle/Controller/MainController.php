<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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



        return $this->render('Public/Main/index.html.twig',
            [
                'produits' => $produits,
                'produitsCarou' => $produitsCarou
            ]);

    }


}
