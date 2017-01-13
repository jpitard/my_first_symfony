<?php

namespace AdminBundle\Controller;

use AdminBundle\Entity\Product;
use AdminBundle\Form\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;



class ProductController extends Controller
{
    /**
     * @Route("/products", name="app_products")
     */
    public function indexAction()
    {
    	//$produits = $this->getProducts();
        $em = $this->getDoctrine()->getManager();
        $produits = $em->getRepository("AdminBundle:Product")
                    ->findAll();

        //die(dump($produits));



        return $this->render('Public/Products/index.html.twig',
        	[
        		'produits' => $produits
        	]);
    }


}
