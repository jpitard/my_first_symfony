<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class RenderCategoryController extends Controller
{

    public function indexAction(Request $request)
    {
        //$produits = $this->getProducts();
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository("AdminBundle:Category")
            ->findAll();


        return $this->render('Public/Category/menuCategory.html.twig',
            [
                'categories' => $categories

            ]);

    }


}
