<?php
/**
 * Created by PhpStorm.
 * User: wamobi8
 * Date: 17/01/17
 * Time: 16:24
 */

namespace AppBundle\Controller;



use AdminBundle\Entity\User;
use AdminBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


/**
 *
 * @Route("/{_locale}")
 */
class TranslationController extends Controller
{

    /**
     *
     * @Route("/translations", name="translation.index")
     */

    public function traductionAction(Request $request)
    {

        $locale =  $request->getLocale();
        $doctrine = $this->getDoctrine();
        $result = $doctrine->getRepository('AdminBundle:Product')->findProductByLocale(12, $locale);
        die(dump($result));

        return $this->render('Public/translation/index.html.twig', [

        ]);

    }


}
