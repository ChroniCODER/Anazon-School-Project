<?php
// src/Controller/MailerController.php
namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Part\DataPart;
use Symfony\Component\Routing\Annotation\Route;

class MailerController extends AbstractController
{
    

    #[Route('/email/product/{id}', name: 'app_email_product')]
    public function sendProductByEmail(MailerInterface $mailer, ProductRepository $productRepository, int $id): Response
    {
            $product = $productRepository->find($id);
            $email = (new TemplatedEmail())
            ->from('hello@example.com')
            ->to('you@example.com')
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->addPart((new DataPart (fopen($this->getParameter('kernel.project_dir').'/public/product-images/ane-en-peluche.jpg', 'r'), 'ane', 'image/jpeg'))->asInline())
            ->htmlTemplate('emails/demo.html.twig')
            ->context([
                    'product' => $product,
                    
            ]);

        $mailer->send($email);

        return new Response('sent');  
    }
}