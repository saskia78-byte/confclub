<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
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
    public function contact(Request $request): Response 
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid()) {
                $data = $form->getData();
                dd($data);
            }
        return $this->render('test/contact.html.twig', [
            'form'=>$form,
        ]);
    }

    #[Route('/aPropos', name: 'app_aPropos')]
    public function aPropos(): Response 
    {
        return $this->render('test/aPropos.html.twig', [
            'name' => 'ConfClub',
            'informations' => [["nom"=>"Année de création: 2020"], ["nom"=>"Public: ouvert à tout.e.s"], ["nom"=>"Type: sujet sociétaux et débats"], ["nom"=>"Intervenants: Sociologues, écrivain.e.s, scientifiques..."]]
        ]);
    }

    #[Route('/article/nouveau', name: 'article_add', methods: ['GET'])]
    public function addArticle(): Response 
    {
        return $this->render('test/articleAdd.html.twig');
    }

    #[Route('/article/{slug}', name: 'article_show')]
    public function show($slug): Response 
    {
        return $this->render('test/article.html.twig', [
            'slug' =>  "Article n° $slug ",
        ]);
    }

    #[Route('/blog', name:'blog_get', methods: ['GET'])]
    public function blog(): Response 
    {
        return new Response("Cette route n'accepte que les get." );
    }

    #[Route('/blog/create', name: 'blog_create', methods: ['POST'])]
    public function create(): Response
    {
        return new Response("Cette route accepte uniquement les requêtes POST.");
    }

    //voir avec id:
    // #[Route('/article/{id}', name: 'article_show')]
    // public function show(int $id): Response 
    // {
    //     return $this->render('test/article.html.twig', [
    //         'id' =>  "Article n° $id ",
    //     ]);
    // }
}
