<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


/**
 * @Route("/produits")
 */
class ProductController extends Controller
{
    /**
     * @Route("/", name="liste_produits")
     */
    public function indexAction()
    {
    	$produits = $this->getProducts();

        return $this->render('Product/index.html.twig',
        	[
        		'produits' => $produits
        	]);
    }

    /**
     * @Route("/new", name="new")
     */
    public function newAction()
    {


    }

    /**
     * @Route("/{id}", name="show", requirements={"id"="\d+"})
     */
    public function showAction($id)
    {
        $leBonProduit = $this->getProducts($id);

        if (empty($leBonProduit)) {

            throw $this->createNotFoundException("Le produit n'existe pas");
        }

        return $this->render('Product/show.html.twig', [

            'produit' => $leBonProduit
        ]);

    }

    /**
     * @Route("/edit", name="edit")
     */
    public function editAction()
    {


    }
    /**
     * @Route("/delete", name="delete")
     */
    public function deleteAction()
    {


    }



   public function getProducts($id = false){

       $bon_produit = [];

       $products = [
           [
               "id" => 1,
               "title" => "Mon premier produit",
               "description" => "lorem ipsum",
               "date_created" => new \DateTime('now'),
               "prix" => 10
           ],
           [
               "id" => 2,
               "title" => "Mon deuxième produit",
               "description" => "lorem ipsum",
               "date_created" => new \DateTime('now'),
               "prix" => 20
           ],
           [
               "id" => 3,
               "title" => "Mon troisième produit",
               "description" => "lorem ipsum",
               "date_created" => new \DateTime('now'),
               "prix" => 30
           ],
           [
               "id" => 4,
               "title" => "",
               "description" => "lorem ipsum",
               "date_created" => new \DateTime('now'),
               "prix" => 410
           ],
       ];

       if ($id){

           foreach ($products as $value){
               if ($value['id'] == $id){

                   $bon_produit = $value;

                   break;
               }
           }
           return $bon_produit;

       }else{

           return $products;

       }
   }
}
