<?php

namespace App\Controller;

use App\Cart\Cart;
use App\Entity\Product;
use App\Form\CartRowType;
use App\Repository\ProductRepository;
use InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'app_cart')]
    public function index(Request $request, ProductRepository $productRepository): Response
    {
        $session = $request->getSession();
        $cart = $this->getCart($session);

        $cartForm = $this->createForm(CartRowType::class);
        $cartForm->handleRequest($request);
        
        if ($cartForm->isSubmitted() && $cartForm->isValid()){
            $data = $cartForm->getData();
            
            $product = $productRepository->find($data['product_id']);

            if(!$product){
                throw new InvalidArgumentException();
            }

            $cart->add($product, $data['quantity']);

            return $this->redirectToRoute('app_cart');
        }
        return $this->render('cart/index.html.twig', [
            'cart' => $cart,
        ]);
    }


    #[Route('/cart/{id}', methods: [ 'DELETE' ])]
    public function deleteRow(
        Product $product,
        SessionInterface $session
    ): JsonResponse
    {
        $cart = $this->getCart($session);
        $cart->removeRow($product);

        return new JsonResponse(null, 204);
    }

    private function getCart(SessionInterface $session): Cart
    {
        if(!$session->has('cart')) {
            $session->set('cart', new Cart());
        }

        /** @var Cart */
        return $session->get('cart');
    }
}
