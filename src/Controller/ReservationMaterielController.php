<?php
namespace App\Controller;

use App\Entity\Materielconf;
use App\Form\ReservationMaterielType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ReservationMaterielController extends AbstractController
{
    #[Route('/reservation/materiel', name: 'app_reservation_materiel')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(ReservationMaterielType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $conf = $data['conf'];
            $dateresa = $data['dateresa'];

            foreach ($data['materiels'] as $materielSelection) {
                $materielconf = new Materielconf();
                $materielconf->setConf($conf);
                $materielconf->setDateresa(\DateTimeImmutable::createFromMutable($dateresa));
                $materielconf->setMateriel($materielSelection->getMateriel());
                $em->persist($materielconf);
            }

            $em->flush();
            return $this->redirectToRoute('app_materielconf_index');
        }

        return $this->render('reservation_materiel/index.html.twig', [
            'form' => $form,
        ]);
    }
}
