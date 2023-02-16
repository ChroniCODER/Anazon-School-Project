<?php

namespace App\Controller;

use App\Entity\Review;
use App\Form\ReviewFormType;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{   
    
    #[Route('/', name: 'app_categories')]
    public function list(CategoryRepository $categoryRepository): Response
    {
        return $this->render('category/list.html.twig', [
            'categories' => $categoryRepository->findAll(),
        ]);
    }

    #[Route('/categories/{id}', name: 'app_category')]
    public function show(CategoryRepository $categoryRepository, string $id): Response
    {
        $review = new Review();
        $form = $this->createForm(ReviewFormType::class, $review);

        return $this->render('category/show.html.twig', [
            'category' => $categoryRepository->findOneById($id),
            'review_form' => $form->createView(),
        ]);
    }

    
}
