<?php

namespace AdminBundle\Controller;

use AdminBundle\Entity\Product;
use AdminBundle\Form\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


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
    	//$produits = $this->getProducts();
        $em = $this->getDoctrine()->getManager();
        $produits = $em->getRepository("AdminBundle:Product")
                    ->findAll();

        //die(dump($produits));



        return $this->render('Product/index.html.twig',
        	[
        		'produits' => $produits
        	]);
    }

    /**
     * @Route("/creer", name="product_create")
     */
    public function createAction(Request $request)
    {
        $product = new Product();

        $formProduct = $this->createForm(ProductType::class, $product);
        $formProduct->handleRequest($request);

        if ($formProduct->isSubmitted() && $formProduct->isValid()) {


            // sauvegarde du produit
            $em = $this->getDoctrine()->getManager();

            $em->persist($product);
            $em->flush();

            $this->addFlash('success', 'Votre produit a bien été ajouté');

            return $this->redirectToRoute('product_create');
        }

        return $this->render('Product/create.html.twig', ['formProduct' => $formProduct->createView()]);

    }

    /**
     * @Route("/new", name="new")
     */
    public function newAction()
    {


    }

    /**
     * @Route("/{id}", name="show")
     */
    public function showAction($id)
    {
        //$leBonProduit = $this->getProducts($id);

        $em = $this->getDoctrine()->getManager();
        $leBonProduit = $em->getRepository("AdminBundle:Product")
            ->find($id);

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
    public function editAction(Request $request)
    {


       /* $formProduct = $this->createForm(ProductType::class);
        $formProduct->handleRequest($request);

        if ($formProduct->isSubmitted() && $formProduct->isValid()) {


            // sauvegarde du produit
            $em = $this->getDoctrine()->getManager();

            $em->persist($product);
            $em->flush();

            $this->addFlash('success', 'Votre produit a bien été ajouté');

            return $this->redirectToRoute('product_create');
        }

        return $this->render('Product/edit.html.twig', ['formProduct' => $formProduct->createView()]);*/


    }
    /**
     * @Route("/delete", name="delete")
     */
    public function deleteAction()
    {


    }



   public function getProducts($id = false){

       $bon_produit = [];
       $bon_produits = [];
       $moyenne_prix = '';
       $somme_prix = '';

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
           
           /*foreach ($products as $value){
            
               $somme_prix += $value['prix'];
              
           }
           $moyenne_prix = $somme_prix / count($products);*/
        
           return $products;

       }
   }
}
