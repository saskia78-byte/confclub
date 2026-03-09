<?php

namespace App\Controller;

use App\Entity\Conf;
use App\Form\ConfType;
use App\Repository\ConfRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/conf')]
final class ConfController extends AbstractController
{
    #[Route(name: 'app_conf_index', methods: ['GET'])]
    public function index(ConfRepository $confRepository): Response
    {
        return $this->render('conf/index.html.twig', [
            'confs' => $confRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_conf_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $conf = new Conf();
        $form = $this->createForm(ConfType::class, $conf);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $conf->setDateAjout(new \DateTimeImmutable);
            $entityManager->persist($conf);
            $entityManager->flush();

            return $this->redirectToRoute('app_conf_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('conf/new.html.twig', [
            'conf' => $conf,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_conf_show', methods: ['GET'])]
    public function show(Conf $conf): Response
    {
        return $this->render('conf/show.html.twig', [
            'conf' => $conf,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_conf_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Conf $conf, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ConfType::class, $conf);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_conf_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('conf/edit.html.twig', [
            'conf' => $conf,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_conf_delete', methods: ['POST'])]
    public function delete(Request $request, Conf $conf, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$conf->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($conf);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_conf_index', [], Response::HTTP_SEE_OTHER);
    }
}
