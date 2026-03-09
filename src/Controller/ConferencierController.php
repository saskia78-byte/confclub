<?php

namespace App\Controller;

use App\Entity\Conferencier;
use App\Form\ConferencierType;
use App\Repository\ConferencierRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/conferencier')]
final class ConferencierController extends AbstractController
{
    #[Route(name: 'app_conferencier_index', methods: ['GET'])]
    public function index(ConferencierRepository $conferencierRepository): Response
    {
        return $this->render('conferencier/index.html.twig', [
            'conferenciers' => $conferencierRepository->findAll(),
        ]);
    }

    #[Route('/conference/{confId}', name: 'app_conferencier_by_conference', methods: ['GET'])]
    public function byConference(int $confId, ConferencierRepository $conferencierRepository): Response
    {
        $conferenciers = $conferencierRepository->findByConference($confId);

        return $this->render('conferencier/index.html.twig', [
            'conferenciers' => $conferenciers,
        ]);
    }

    #[Route('/new', name: 'app_conferencier_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $conferencier = new Conferencier();
        $form = $this->createForm(ConferencierType::class, $conferencier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($conferencier);
            $entityManager->flush();

            return $this->redirectToRoute('app_conferencier_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('conferencier/new.html.twig', [
            'conferencier' => $conferencier,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_conferencier_show', methods: ['GET'])]
    public function show(Conferencier $conferencier): Response
    {
        return $this->render('conferencier/show.html.twig', [
            'conferencier' => $conferencier,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_conferencier_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Conferencier $conferencier, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ConferencierType::class, $conferencier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_conferencier_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('conferencier/edit.html.twig', [
            'conferencier' => $conferencier,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_conferencier_delete', methods: ['POST'])]
    public function delete(Request $request, Conferencier $conferencier, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$conferencier->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($conferencier);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_conferencier_index', [], Response::HTTP_SEE_OTHER);
    }
}
