<?php
namespace App\Tests\Integration\Repository;

use App\Entity\Conf;
use App\Entity\Materiel;
use App\Entity\Materielconf;
use App\Entity\Theme;
use App\Repository\ConfRepository;
use App\Repository\MaterielconfRepository;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ConfRepositoryTest extends KernelTestCase
{
    private $repo;
    private $repo2;
    private EntityManagerInterface $em;

    protected function setUp(): void
    {
        self::bootKernel();
        $container = self::getContainer();
        $this->repo = $container->get(ConfRepository::class);
        $this->repo2 = $container->get(MaterielconfRepository::class);


        $this->em = self::getContainer()->get(EntityManagerInterface::class);
        $purger = new ORMPurger($this->em);
        $purger->purge();
    }

    public function testAjoutConf(): void 
    {
        $theme = (new Theme())->setLibelle('éco-féminisme');
        $conf = (new Conf())->setTitre('Conf A')->setDescription('Description')->setDateConf(new \DateTime('+2days'))->setDateAjout(new \DateTimeImmutable())->setStatut('En préparation')->setTheme($theme);

        $em = self::getContainer()->get('doctrine')->getManager();
        $em->persist($conf);
        $em->flush();

        $result = $this->repo->findByListCount();
        self::assertCount(1, $result);
        self::assertSame('Conf A', $result[0]->getTitre());
    }

    public function testInteMaterielConf(): void
    {

        $materiel1 = (new Materiel())->setLibelle('Sono');
        $materiel2 = (new Materiel())->setLibelle('Micro');
        $materiel3 = (new Materiel())->setLibelle('Ampli');
        $theme = (new Theme())->setLibelle('éco-féminisme');
        $conf = (new Conf())->setTitre('Conf A')->setDescription('Description')->setDateConf(new \DateTime('+2days'))->setDateAjout(new \DateTimeImmutable())->setStatut('En préparation')->setTheme($theme);
        $materielConf1 = (new Materielconf())->setConf($conf)->setMateriel($materiel1)->setDateresa(new \DateTimeImmutable());
        $materielConf2 = (new Materielconf())->setConf($conf)->setMateriel($materiel2)->setDateresa(new \DateTimeImmutable());
        $materielConf3 = (new Materielconf())->setConf($conf)->setMateriel($materiel3)->setDateresa(new \DateTimeImmutable());

        $em = self::getContainer()->get('doctrine')->getManager();
        $em->persist($materiel1);
        $em->persist($materiel2);
        $em->persist($materiel3);
        $em->persist($conf);
        $em->persist($materielConf1);
        $em->persist($materielConf2);
        $em->persist($materielConf3);
        $em->flush();

        $result = $this->repo2->findAll();
        self::assertCount(3, $result);
    }

    // public function testDeleteMaterielConf(): void
    // {

    // }

}