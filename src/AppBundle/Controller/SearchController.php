<?php

namespace AppBundle\Controller;

use AdminBundle\Entity\Brand;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 *
 * @Route("")
 */
class SearchController extends Controller
{
    /**
     * @Route("search", name="search")
     *
     */
    public function searchAction(Request $request)
    {

        return $this->render('Public/search/index.html.twig');

    }

    /**
     * @Route("search-ajax", name="search.ajax")
     *
     */
    public function searchAjaxAction(Request $request)
    {
        $data= $request->get('data');

       // die(dump($data));
        $doctrine = $this->getDoctrine();
        $results = $doctrine->getRepository('AdminBundle:Product')->searchByName($data);

        return new JsonResponse($results);

    }
}
