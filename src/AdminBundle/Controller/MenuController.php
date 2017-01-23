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

            array('intitule_onglet' => 'Tableau de bord','lien' => $this->generateUrl('admin'), 'icone' => 'dashboard'),
            array('intitule_onglet' => 'Produits', 'lien' => $this->generateUrl('product_list'), 'icone' => ''),
            array('intitule_onglet' => 'Categories', 'lien' => $this->generateUrl('categories_list'), 'icone' => ''),
            array('intitule_onglet' => 'Marques', 'lien' => $this->generateUrl('brand_index'), 'icone' => ''),
            array('intitule_onglet' => 'Users', 'lien' => $this->generateUrl('user_list'), 'icone' => '')

        );

        return $this->render('Partials/main_sidebar.html.twig', array('json' => $tab_menu));
    }

}
