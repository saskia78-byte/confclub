<?php

namespace App\Controller;

use App\Entity\Confmateriel;
use App\Form\ConfmaterielType;
use App\Repository\ConfmaterielRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/confmateriel')]
final class ConfmaterielController extends AbstractController
{
    #[Route(name: 'app_confmateriel_index', methods: ['GET'])]
    public function index(ConfmaterielRepository $confmaterielRepository): Response
    {
        return $this->render('confmateriel/index.html.twig', [
            'confmateriels' => $confmaterielRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_confmateriel_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $confmateriel = new Confmateriel();
        $form = $this->createForm(ConfmaterielType::class, $confmateriel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($confmateriel);
            $entityManager->flush();

            return $this->redirectToRoute('app_confmateriel_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('confmateriel/new.html.twig', [
            'confmateriel' => $confmateriel,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_confmateriel_show', methods: ['GET'])]
    public function show(Confmateriel $confmateriel): Response
    {
        return $this->render('confmateriel/show.html.twig', [
            'confmateriel' => $confmateriel,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_confmateriel_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Confmateriel $confmateriel, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ConfmaterielType::class, $confmateriel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_confmateriel_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('confmateriel/edit.html.twig', [
            'confmateriel' => $confmateriel,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_confmateriel_delete', methods: ['POST'])]
    public function delete(Request $request, Confmateriel $confmateriel, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$confmateriel->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($confmateriel);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_confmateriel_index', [], Response::HTTP_SEE_OTHER);
    }
}
