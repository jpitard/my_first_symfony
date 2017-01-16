<?php

namespace AppBundle\Controller;

use AdminBundle\Entity\Category;
use AdminBundle\Form\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


/**
 * @Route("/categories")
 */
class CategoryController extends Controller
{

    /**
     * @Route("/{id}", name="app_products_by_category")
     */
    public function indexAction(Category $category, Request $request)
    {

        if (empty($category)) {

            throw $this->createNotFoundException("La categorie n'existe pas");
        }

        $em = $this->getDoctrine()->getManager();

        $page = $request->query->get('page', 1);

        //die(dump($page));

        if ($page <= 0) {
            $page = 1;
        }

        $offset = ($page - 1) * 4;

        $products = $em->getRepository('AdminBundle:Product')->myFindProductionSelonCategorie($category->getId(), $offset);

        $nbProducts = count( $em->getRepository('AdminBundle:Product')->FindProductsByCategoryCount($category->getId()));
        $nbPages = 0;

         if ($nbProducts % 4 == 0){
             //die(dump('pas de virgules'));
            $nbPages = $nbProducts/4;
         }else{
             //die(dump('virgules'));

            $nbPages = ($nbProducts + 1)/4;
         }


        //die(dump( $nbPages));


        return $this->render('Public/Products/list_by_category.html.twig',
            [
                'products' => $products,
                'category' => $category,
                'nbPages' => $nbPages
            ]);
    }







}
