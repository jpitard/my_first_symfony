<?php

namespace AdminBundle\Controller;

use AdminBundle\Entity\Brand;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Brand controller.
 *
 * @Route("admin/brand")
 */
class BrandController extends Controller
{
    /**
     * Lists all brand entities.
     *
     * @Route("/", name="brand_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
         $sort = $request->query->get("sort", "ASC");

        //die(dump($sort));

        $em = $this->getDoctrine()->getManager();


       // $brands = $em->getRepository('AdminBundle:Brand')->findAll();
        $brands = $em->getRepository('AdminBundle:Brand')->findBy([], ["title"=>$sort]);

        return $this->render('brand/index.html.twig', array(
            'brands' => $brands,
        ));
    }

    /**
     * Creates a new brand entity.
     *
     * @Route("/new", name="brand_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $brand = new Brand();
        $form = $this->createForm('AdminBundle\Form\BrandType', $brand);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($brand);
            $em->flush($brand);

            $this->addFlash('success', 'Votre marque a bien été ajoutée');
            return $this->redirectToRoute('brand_show', array('id' => $brand->getId()));
        }

        return $this->render('brand/new.html.twig', array(
            'brand' => $brand,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a brand entity.
     *
     * @Route("/{id}", name="brand_show")
     * @Method("GET")
     */
    public function showAction(Brand $brand)
    {
        $deleteForm = $this->createDeleteForm($brand);

        return $this->render('brand/show.html.twig', array(
            'brand' => $brand,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing brand entity.
     *
     * @Route("/{id}/edit", name="brand_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Brand $brand)
    {
        $deleteForm = $this->createDeleteForm($brand);
        $editForm = $this->createForm('AdminBundle\Form\BrandType', $brand);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('brand_edit', array('id' => $brand->getId()));
        }

        return $this->render('brand/edit.html.twig', array(
            'brand' => $brand,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a brand entity.
     *
     * @Route("/{id}", name="brand_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Brand $brand)
    {
        $form = $this->createDeleteForm($brand);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($brand);
            $em->flush($brand);

            $messageSuccess = 'Votre produit a été supprimé';
            if ($request->isXmlHttpRequest()) {
                // use Symfony\Component\HttpFoundation\JsonResponse;
                return new JsonResponse(['message' => $messageSuccess]);
            }

            $this->addFlash('success', 'Votre produit a été supprimé');
        }

        return $this->redirectToRoute('brand_index');
    }

    /**
     * Creates a form to delete a brand entity.
     *
     * @param Brand $brand The brand entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Brand $brand)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('brand_delete', array('id' => $brand->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
