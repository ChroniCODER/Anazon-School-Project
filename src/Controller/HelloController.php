<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloController extends AbstractController
{
    #[Route('/hello/{name<\w+>}', methods: ['GET'], name: 'app_hello')]
    public function index(Request $request, string $name = 'remi'): Response
    {
        //dd($request->headers);

        return $this->render('hello/index.html.twig', [
            'controller_name' => 'HelloController',
        ]);

       /*  return new JsonResponse([
            'name' => $name,
        ]); */
    }
}
