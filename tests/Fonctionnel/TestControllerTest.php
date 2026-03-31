<?php
namespace App\Tests\Fonctionnel;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TestControllerTest extends WebTestCase
{
    public function testPageAccueil(): void
    {
        $client = static::createClient();
        $client->request('GET', '/conf');

        self::assertResponseIsSuccessful();
    }

    public function testContenu(): void
    {
        $client = static::createClient();
        $client->request('GET', '/conf');

        self::assertSelectorTextContains('h1', 'Conférences');
    }

    public function testCreationConf(): void
    {
        $client = static::createClient();
        $em = static::getContainer()->get('doctrine')->getManager();

        // ── User ──
        $user = $em->getRepository(\App\Entity\User::class)
                ->findOneBy(['email' => 'admin@test.com']);
        if (!$user) {
            $user = new \App\Entity\User();
            $user->setEmail('admin@test.com');
            $user->setNom('Lillo');
            $user->setPrenom('Emma');
            $user->setRoles(['ROLE_ADMIN']);
            $user->setPassword('fake-password');
            $em->persist($user);
        }

        // ── Conférencier ──
        $conferencier = $em->getRepository(\App\Entity\Conferencier::class)
                        ->findOneBy(['nom' => 'Dupont']);
        if (!$conferencier) {
            $conferencier = new \App\Entity\Conferencier();
            $conferencier->setNom('Dupont');
            $conferencier->setPrenom('Jean');
            $em->persist($conferencier);
        }

        // ── Thème ──
        $theme = $em->getRepository(\App\Entity\Theme::class)
                    ->findOneBy(['libelle' => 'Informatique']);
        if (!$theme) {
            $theme = new \App\Entity\Theme();
            $theme->setLibelle('Informatique');
            $em->persist($theme);
        }

        $em->flush();

        // 2. Connecte-le
        $client->loginUser($user);

        // dump($client->getResponse()->getStatusCode()); // ex: 200, 302, 500
        // dump($client->getResponse()->getContent());     // affiche le HTML brut

        $crawler = $client->request('GET', '/conf/new');

        // Récupère le token CSRF depuis le formulaire
        $token = $crawler->filter('#conf__token')->attr('value');

        // Soumet directement en POST sans passer par le crawler
        $client->request('POST', '/conf/new', [
            'conf' => [
                'titre'          => 'Conf Test',
                'dateConf'       => '2026-04-12T10:55',
                'description'    => 'Description',
                'statut'         => 'En préparation',
                'conferencier'   => [$conferencier->getId()],
                'theme'          => $theme->getId(),
                '_token'         => $token,
            ]
        ]);

        self::assertResponseRedirects('/conf');

        // $client->followRedirect();
        // self::assertSelectorTextContains('body', 'Conf Test');
    }

    

}