<?php

namespace AppBundle\Controller;

use AdminBundle\Entity\Product;
use AdminBundle\Form\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


/**
 * @Route("/produits")
 */
class ProductController extends Controller
{
    /**
     * @Route("/", name="app_products")
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

    /**
     * @Route("/{id}", name="app_products_show")
     */
    public function showAction(Product $product)
    {


        if (empty($product)) {

            throw $this->createNotFoundException("Le produit n'existe pas");
        }


        return $this->render('Public/Products/show.html.twig',
            [
                'product' => $product
            ]);
    }







}
