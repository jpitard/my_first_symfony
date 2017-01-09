<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class MenuController extends Controller
{
    public function indexAction(Request $request)
    {
       // $router = $this->get("router");
        //$route = $router->match($this->getRequest()->getPathInfo());
        //var_dump($route['_route']);



        $tab_menu = array(

            array('intitule_onglet' => 'Tableau de bord','route' => 'admin', 'lien' => $this->generateUrl('admin'), 'icone' => 'dashboard'),
            array('intitule_onglet' => 'Produits', 'route' => 'product_list','lien' => $this->generateUrl('product_list'), 'icone' => ''),
            array('intitule_onglet' => 'Categories', 'route' => 'category_list', 'lien' => $this->generateUrl('categories_list'), 'icone' => '')

        );

        return $this->render('Partials/main_sidebar.html.twig', array('json' => $tab_menu));
    }

}
