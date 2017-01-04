<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class MenuController extends Controller
{
    public function indexAction()
    {

        $tab_menu = array(

            array('intitule_onglet' => 'Tableau de bord', 'lien' => $this->generateUrl('admin'), 'icone' => 'dashboard'),
            array('intitule_onglet' => 'Produits', 'lien' => $this->generateUrl('liste_produits'), 'icone' => ''),
            array('intitule_onglet' => 'Categories', 'lien' => $this->generateUrl('liste_categories'), 'icone' => '')

        );

        return $this->render('Partials/main_sidebar.html.twig', array('json' => $tab_menu));
    }

}
