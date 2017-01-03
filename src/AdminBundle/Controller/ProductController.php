<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ProductController extends Controller
{
    /**
     * @Route("/admin/produits")
     */
    public function indexAction()
    {
        return $this->render('AdminBundle:Product:index.html.twig');
    }
}
