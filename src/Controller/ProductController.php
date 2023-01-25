<?php

namespace App\Controller;

use App\Entity\Review;
use App\Form\ReviewFormType;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/products/{id}', name: 'app_product')]
    public function detail(ProductRepository $productRepository, string $id): Response
    {
        $review = new Review();
        $form = $this->createForm(ReviewFormType::class, $review);

        return $this->render('product/detail.html.twig', [
            'product' => $productRepository->findOneById($id),
            'review_form' => $form->createView(),
        ]);
    }
}
