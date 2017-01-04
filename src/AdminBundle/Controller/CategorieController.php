<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/categories")
 */
class CategorieController extends Controller
{
    /**
     * @Route("/", name="liste_categories")
     */
    public function indexAction()
    {
    	$categories = $this->getProducts();

        return $this->render('Category/index.html.twig',
        	[
        		'categories' => $categories
        	]);
    }

    /**
     * @Route("/new", name="new_cat")
     */
    public function newAction()
    {


    }

    /**
     * @Route("/{id}", name="show_cat", requirements={"id"="\d+"})
     */
    public function showAction($id)
    {
        $leBonCategorie = $this->getProducts($id);

        if (empty($leBonCategorie)) {

            throw $this->createNotFoundException("La catégorie n'existe pas");
        }

        return $this->render('Category/show.html.twig', [

            'categorie' => $leBonCategorie
        ]);

    }

    /**
     * @Route("/edit", name="edit_cat")
     */
    public function editAction()
    {


    }
    /**
     * @Route("/delete", name="delete_cat")
     */
    public function deleteAction()
    {


    }



   public function getProducts($id = false){

       $bon_categorie = [];

       $categories = [
           1 => [
               "id" => 1,
               "title" => "Homme",
               "description" => "lorem ipsum \n suite du contenu Vivamus pellentesque non nunc nec mattis. Donec et mauris orci. Cras ut sem commodo.",
               "date_created" => new \DateTime('now'),
               "active" => true
           ],
           2 => [
               "id" => 2,
               "title" => "Femme",
               "description" => "<strong>lorem</strong> ipsum",
               "date_created" => new \DateTime('-10 Days'),
               "active" => true
           ],
           3 => [
               "id" => 3,
               "title" => "Enfant",
               "description" => "lorem ipsum Vivamus pellentesque non nunc nec mattis. Donec et mauris orci. \n Cras ut sem commodo, posuere nisl quis.",
               "date_created" => new \DateTime('-1 Days'),
               "active" => false
           ],
       ];

       if ($id){

           foreach ($categories as $value){
               if ($value['id'] == $id){

                   $bon_categorie = $value;

                   break;
               }
           }
           return $bon_categorie;

       }else{

           return $categories;

       }
   }
}
