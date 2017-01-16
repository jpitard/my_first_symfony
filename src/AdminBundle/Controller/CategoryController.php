<?php

namespace AdminBundle\Controller;

use AdminBundle\Entity\Category;
use AdminBundle\Entity\Product;
use AdminBundle\Form\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
/**
 * @Route("admin/categories")
 */
class CategoryController extends Controller
{
    /**
     * @Route("/", name="categories_list")
     */
    public function indexAction()
    {
        //$produits = $this->getProducts();
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository("AdminBundle:Category")
            ->findAll();


        return $this->render('Category/index.html.twig',
        	[
        		'categories' => $categories
        	]);
    }

    /**
     * @Route("/creer", name="category_create")
     */
    public function createAction(Request $request)
    {
        $category = new Category();

        $formCategory = $this->createForm(CategoryType::class, $category);
        $formCategory->handleRequest($request);

        if ($formCategory->isSubmitted() && $formCategory->isValid()) {


            // sauvegarde du produit
            $em = $this->getDoctrine()->getManager();

            $em->persist($category);
            $em->flush();

            $this->addFlash('success', 'Votre categorie a bien été ajouté');

            return $this->redirectToRoute('category_create');
        }

        return $this->render('Category/new.html.twig', ['formCategory' => $formCategory->createView()]);

    }

    /**
     * @Route("/{id}", name="category_show")
     * @ParamConverter("category", class="AdminBundle:Category")
     */
    public function showAction(Category $category)
    {
        //die(dump($category));

       /* $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository("AdminBundle:Category")
            ->find($id);

        if (empty($category)) {

            throw $this->createNotFoundException("La categorie n'existe pas");
        }*/

        return $this->render('Category/show.html.twig', [

            'categorie' => $category
        ]);

    }

    /**
     * @Route("/editer/{id}", name="category_edit")
     */
    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository('AdminBundle:Category')->find($id);

        // Vérification si le produit est bien en BDD
        if (!$category) {
            throw $this->createNotFoundException("La categorie n'existe pas");
        }


        // Création du formulaire ProductType permettant de créer un produit
        // Je lie le formulaire à mon objet $product
        $formCategory = $this->createForm(CategoryType::class, $category);

        // Je lie la requête ($_POST) à mon formulaire donc à mon objet $product
        $formCategory->handleRequest($request);

        // Je valide mon formulaire
        if ($formCategory->isSubmitted() && $formCategory->isValid()) {

            // La ligne ci-dessous n'est pas obligatoire car doctrine est au courant de l'existance de $product
            // $em->persist($product);
            $em->flush();

            $this->addFlash('success', 'Votre categorie a été mis à jour');

            return $this->redirectToRoute('category_show', ['id' => $id]);
        }

        return $this->render('Category/edit.html.twig', ['formCategory' => $formCategory->createView(), 'category' => $category]);
    }

    /**
     * @Route("/supprimer/{id}", name="category_remove")
     */
    public function removeAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository('AdminBundle:Category')->find($id);

        // Vérification si le produit est bien en BDD
        if (!$category) {
            throw $this->createNotFoundException("La categorie n'existe pas");
        }

        $em->remove($category);
        $em->flush();

        $messageSuccess = 'Votre categorie a été supprimé';


        if ($request->isXmlHttpRequest()) {
            // use Symfony\Component\HttpFoundation\JsonResponse;
            return new JsonResponse(['message' => $messageSuccess]);
        }

        $this->addFlash('success', 'Votre categorie a été supprimé');

        // Redirection sur la page qui liste tous les produits
        return $this->redirectToRoute('categories_list');
    }


    public function getProducts($id = false){

       $bon_categorie = [];

       $categories = [
           1 => [
               "id" => 1,
               "title" => "Homme",
               "description" => "lorem ipsum suite du contenu Vivamus \n pellentesque non nunc nec mattis. \n Donec et mauris orci. Cras ut sem commodo.",
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
               "description" => "lorem ipsum Vivamus pellentesque \n non nunc nec mattis. Donec et mauris orci. \n Cras ut sem commodo, posuere nisl quis.",
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
