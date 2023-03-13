<?php

namespace App\Controller;

use App\Entity\Review;
use App\Form\CartRowType;
use App\Form\ReviewFormType;
use App\Repository\ProductRepository;
use App\Repository\ReviewRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends AbstractController
{
    #[Route('/products/{id}', name: 'app_product')]
    public function detail(ProductRepository $productRepository, string $id, EntityManagerInterface $em, Request $request, ReviewRepository $reviewRepository): Response
    {

        $review = new Review();
        $product = $productRepository->findOneById($id);

        $form = $this->createForm(ReviewFormType::class, $review);
        $form->get('user')->setData($this->getUser());

        $form->get('product')->setData($product);
        $category = $product->getCategory();
        $review->setProduct($product);
        $review->setUser($this->getUser());

        $cartForm = $this->createForm(CartRowType::class, [
            'product_id' => $product->getId(),
        ], [
            'action' => $this->generateUrl('app_cart'),
        ]);
        
        $existingReview = $reviewRepository->findOneBy(['product' => $product, 'user' => $this->getUser()]);
        if ($existingReview) {
            // l'utilisateur a déjà déposé une critique pour ce produit
            
            return $this->render('product/detail.html.twig', [
                'category' => $category,
                'existingReview' => $existingReview,
                'product' => $productRepository->findOneById($id),
                'cart_form' => $cartForm,
            ]);
        } else {


            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $em->persist($review);
                $em->flush();
                $this->addFlash('success', 'Votre review a été ajoutée avec succès');
                return $this->redirectToRoute('app_product', ['id' => $product->getId()]);
            }


            return $this->render('product/detail.html.twig', [
                'category' => $category,
                'product' => $productRepository->findOneById($id),
                'existingReview' => $existingReview,
                'cart_form' => $cartForm,
                'review_form' => $form->createView(),

            ]);
        }
    }
}
