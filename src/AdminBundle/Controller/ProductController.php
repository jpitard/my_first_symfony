<?php

namespace AdminBundle\Controller;

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
     * @Route("/", name="product_list")
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

            //Recuperer l'image
            //$image= $product->getImage();

            //die(dump($image));

            //service utils
            //$serviceUtils = $this->get('admin.service.utils.string');
            //$fileName = $serviceUtils->generateUniqId() . '.' . $image->guessExtension( );
            //die(dump($fileName));
            //transfert
            //die(dump($product));
            //$renameImage = $fileName.'.'.$image->guessExtension();

           /*$uploadService = $this->get('admin.service.upload');
             $uploadService->upload($image);
            $nameImage = $uploadService->getNameImage();*/
            // $image->move('upload/',$fileName );

            //$product->setImage($nameImage);
           // die(dump($product , $nameImage));

            $em->persist($product);
            $em->flush();
            $this->addFlash('success', 'Votre produit a bien été ajouté');
            return $this->redirectToRoute('product_create');
        }

        return $this->render('Product/new.html.twig', ['formProduct' => $formProduct->createView()]);

    }



    /**
     * @Route("/{id}", name="product_show")
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
     * @Route("/editer/{id}", name="product_edit")
     */
    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('AdminBundle:Product')->find($id);

        // Vérification si le produit est bien en BDD
        if (!$product) {
            throw $this->createNotFoundException("Le produit n'existe pas");
        }


        // Création du formulaire ProductType permettant de créer un produit
        // Je lie le formulaire à mon objet $product
        $formProduct = $this->createForm(ProductType::class, $product);

        // Je lie la requête ($_POST) à mon formulaire donc à mon objet $product
        $formProduct->handleRequest($request);

        // Je valide mon formulaire
        if ($formProduct->isSubmitted() && $formProduct->isValid()) {

            // La ligne ci-dessous n'est pas obligatoire car doctrine est au courant de l'existance de $product
            // $em->persist($product);
            $em->flush();

            $this->addFlash('success', 'Votre produit a été mis à jour');

            return $this->redirectToRoute('product_show', ['id' => $id]);
        }

        return $this->render('Product/edit.html.twig', ['formProduct' => $formProduct->createView(), 'product' => $product]);
    }

    /**
     * @Route("/supprimer/{id}", name="product_remove")
     */
    public function removeAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('AdminBundle:Product')->find($id);

        // Vérification si le produit est bien en BDD
        if (!$product) {
            throw $this->createNotFoundException("Le produit n'existe pas");
        }

        $em->remove($product);
        $em->flush();

        $messageSuccess = 'Votre produit a été supprimé';


        if ($request->isXmlHttpRequest()) {
            // use Symfony\Component\HttpFoundation\JsonResponse;
            return new JsonResponse(['message' => $messageSuccess]);
        }

        $this->addFlash('success', 'Votre produit a été supprimé');

        // Redirection sur la page qui liste tous les produits
        return $this->redirectToRoute('product_list');
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
