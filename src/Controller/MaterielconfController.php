<?php

namespace App\Controller;

use App\Entity\Materielconf;
use App\Form\MaterielconfType;
use App\Repository\MaterielconfRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/materielconf')]
final class MaterielconfController extends AbstractController
{
    #[Route(name: 'app_materielconf_index', methods: ['GET'])]
    public function index(MaterielconfRepository $materielconfRepository): Response
    {
        return $this->render('materielconf/index.html.twig', [
            'materielconfs' => $materielconfRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_materielconf_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $materielconf = new Materielconf();
        $form = $this->createForm(MaterielconfType::class, $materielconf);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($materielconf);
            $entityManager->flush();

            return $this->redirectToRoute('app_materielconf_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('materielconf/new.html.twig', [
            'materielconf' => $materielconf,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_materielconf_show', methods: ['GET'])]
    public function show(Materielconf $materielconf): Response
    {
        return $this->render('materielconf/show.html.twig', [
            'materielconf' => $materielconf,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_materielconf_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Materielconf $materielconf, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MaterielconfType::class, $materielconf);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_materielconf_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('materielconf/edit.html.twig', [
            'materielconf' => $materielconf,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_materielconf_delete', methods: ['POST'])]
    public function delete(Request $request, Materielconf $materielconf, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$materielconf->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($materielconf);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_materielconf_index', [], Response::HTTP_SEE_OTHER);
    }
}
