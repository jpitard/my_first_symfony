<?php

namespace AppBundle\Controller;


use AdminBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


class PanierController extends Controller
{

    private function createCart(Request $request){
        if (!$request->getSession()->get('cart')){

            $request->getSession()->set('cart', [
                'id' => [],
                'qty' => []
            ]);
        }

    }

    /**
     * @Route("/add/cart/{id}", name="add_cart")
     *
     * @ParamConverter("product", class="AdminBundle:Product")
     */
    public function addCartAction(Product $product, Request $request)
    {
        $idProduct = $product->getId();
        $qty = $request->get('qty');

        //die(dump($idProduct, $qty));

        $this->createCart($request);
        //$idCartExist = $request->getSession()->get("cart")['id'];

        $idCart = $request->getSession()->get("cart");

        //die(dump($idProduct, $qty, $idCart));

        if (in_array($idProduct,$idCart['id'] )){

            //recupère la postiion du produit
            $position=array_search($idProduct,$idCart['id'] );

            //recupère la postiion de la quantité qui doit etre a la position que le produit
            $recupQty = $idCart['qty'][$position];
            $newQty = $recupQty + $qty;

            //reinjecter la nouvelle quantité calculée
            $idCart['qty'][$position] = $newQty;


            //mettre a jour le tableau dans la session
            $request->getSession()->set('cart',[
                'id' => $idCart['id'],
                'qty' => $idCart['qty']
            ]);


            //die(dump('dans le tableau', $position, $recupQty, $idCartExist['qty']));
        }else{

            $idCart['qty'][] = $qty;
            $idCart['id'][] = $idProduct;


            $request->getSession()->set('cart',[
                'id' =>  $idCart['id'],
                'qty' => $idCart['qty']
            ]);

           // die(dump('pas dans le tableau'));

            return $this->redirectToRoute('app_products_show', ['id'=>$product->getId()]);
        }


        //die(dump($request->getSession()->get("cart")));
    }


    /**
     * @Route("/show/cart/", name="show_cart")
     *
     *
     */
    public function showCartAction(Request $request)
    {
        $idCart = $request->getSession()->get('cart')['id'];
        $idQty = $request->getSession()->get('cart')['qty'];
        $message = " ";


        $em = $this->getDoctrine()->getManager();

        $tabproducts =[];

        if ($idCart){
            foreach ($idCart as $key=>$value){

                $tabproducts[$value]['product'] = $em->getRepository("AdminBundle:Product")->find($value);
                $tabproducts[$value]['qty'] = $idQty[$key];
            }

        }else{

            $message = " Votre panier est vide";
        }
        //die(dump($tabproducts, $idCart));
        return $this->render('Public/Cart/index.html.twig',
            [
                'tabproducts' => $tabproducts,
                'message' => $message
            ]);

    }

    /**
     * @Route("/update/cart/", name="update_cart")
     *
     *
     */
    public function updateCartAction(Request $request)
    {
        $qty = $request->get('qty');
        $id = $request->get('id');

        $request->getSession()->set('cart',[
            'id' => $id,
            'qty' => $qty
        ]);

        return $this->redirectToRoute('show_cart');

    }
    /**
     * @Route("/remove/cart/{id}", name="remove_cart")
     *
     * @ParamConverter("product", class="AdminBundle:Product")
     */
    public function removeCartAction(Product $product, Request $request)
    {
        $id = $product->getId();
        $cart = $request->getSession()->get('cart');

        //recupère la postiion du produit
        $position=array_search($id,$cart['id'] );

        array_splice($cart['id'], $position,1);
        array_splice($cart['qty'], $position,1);

        $request->getSession()->set('cart', $cart);


        return $this->redirectToRoute('show_cart');

    }




}
