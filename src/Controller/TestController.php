<?php

namespace App\Controller;

use Doctrine\ORM\Query\Expr\Func;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TestController extends AbstractController
{
    #[Route('/', name: 'app_test')]
    public function index(): Response
    {
        return $this->render('test/index.html.twig', [
            'controller_name' => 'Bienvenue au confclub Manager',
        ]);
    }

    #[Route('/contact', name: 'app_contact')]
    public function contact(): Response 
    {
        return $this->render('test/contact.html.twig');
    }

    #[Route('/aPropos', name: 'app_aPropos')]
    public function aPropos(): Response 
    {
        return $this->render('test/aPropos.html.twig', [
            'name' => 'À propos',
        ]);
    }
}
