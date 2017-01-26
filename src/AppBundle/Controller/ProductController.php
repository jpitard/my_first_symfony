<?php

namespace AppBundle\Controller;

use AdminBundle\Entity\Comment;
use AdminBundle\Entity\Product;
use AdminBundle\Form\CommentType;
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
    public function showAction(Product $product, Request $request)
    {

        if (empty($product)) {

            throw $this->createNotFoundException("Le produit n'existe pas");
        }

        //dump($product); exit;
        // sauvegarde le commentaire
        $em = $this->getDoctrine()->getManager();

        $repComments = $em->getRepository("AdminBundle:Comment")
            ->FindCommentsByProduct($product->getId());

        //dump($repComments); exit;

        $comment = new Comment();
        $formComment = $this->createForm(CommentType::class, $comment );
        $formComment->handleRequest($request);

        if ($formComment->isSubmitted() && $formComment->isValid()) {

            $comment->setProduct($product);
            $em->persist($comment);
            $em->flush();
            $this->addFlash('success', 'Votre commentaire a bien été ajouté');

            return $this->redirectToRoute('app_products_show', ['id'=>$product->getId()]);
        }


        return $this->render('Public/Products/show.html.twig',
            [
                'product' => $product,
                'repComments' => $repComments,
                'formComment' => $formComment->createView()
            ]);
    }







}
