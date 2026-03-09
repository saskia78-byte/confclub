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

final class ConfController extends AbstractController
{
    #[Route('/conf', name: 'app_conf')]
    public function index(): Response
    {
        return $this->render('conf/index.html.twig', [
            'controller_name' => 'ConfController',
        ]);
    }

    #[Route('/confs', name: 'app_confs')]
    public function confs(ConfRepository $confRepository) {
        $confs = $confRepository->findAll();
    }

    #[Route('/conf/{id}/show', name: 'app_conf')]
    public function showConf(conf $conf): Response {
        dd($conf);
    }

    #[Route('/conf/{id}/update', name: 'update_conf')]
    public function updateConf(EntityManagerInterface $em, int $id) : Response {
        $repository = $em->getRepository(Conf::class);
        $conf = $repository->find($id);
        $conf->setTitre('Nouveau titre conf $id');
        $em->flush();
        dd($conf);

    }

    #[Route('/conf/{id}/delete', name: 'delete_conf')]
    public function deleteConf(EntityManagerInterface $em, int $id) : Response {
        $repository = $em->getRepository(Conf::class);
        $conf = $repository->find($id);
        $em->remove($conf);
        $em->flush();
        return $this->redirectToRoute('app_confs');
    }

    #[Route('/conf/creer', name: 'creer_conf')]
    public function creerConf(EntityManagerInterface $em, Request $request) : Response {
        $conf = new Conf();
        $form = $this->createForm(ConfType::class, $conf);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $conf->setDateAjout(new \DateTimeImmutable);
            $em->persist($conf);
            $em->flush();
            return $this->redirectToRoute('app_confs');
        }
        
        return $this->render('conf/creer.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
