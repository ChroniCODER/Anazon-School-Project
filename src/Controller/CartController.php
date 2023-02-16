<?php

namespace App\Controller;


use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'cart_add')]
    public function addToCart(Request $request, SessionInterface $session, ProductRepository $productRepository): Response
    {
        /* if ($request->isMethod('POST')) {
    } */

        $productId = $request->request->get('product_id');
        $quantity = $request->request->get('quantity');

        $product = $productRepository->find($productId);

        if (!$product) {
            throw $this->createNotFoundException('The product does not exist');
        }

        $cart = $session->get('cart', []);


        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'name' => $product->getName(),
                'price' => $product->getPrice(),
                'quantity' => $quantity,
            ];
        }

        $session->set('cart', $cart);

        // return $this->redirectToRoute('cart_add');
        return $this->render('cart/index.html.twig', [
            'session' => $session,
            'cart' => $cart,
        ]);
    }
    #[Route('/cartCheck', name: 'cart_check')]
    public function index(SessionInterface $session): Response
    {
        $cart = $session->get('cart', []);

        return $this->render('cart/index.html.twig', [
            'session' => $session,
            'cart' => $cart,

        ]);
    }
}
    /* public function index(): Response
    {
        return $this->render('cart/index.html.twig', [
            'controller_name' => 'CartController',
        ]);
    } */
