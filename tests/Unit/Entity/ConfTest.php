<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Conf;
use App\Entity\Conferencier;
use App\Entity\Materiel;
use App\Entity\Materielconf;
use PHPUnit\Framework\TestCase;

class ConfTest extends TestCase
{
    public function testSetAndGetTitre(): void
    {
        $conf = new Conf();
        $conf->setTitre('Conférence éco-féminisme');
        self::assertSame('Conférence éco-féminisme', $conf->getTitre());
    }

    public function testAddConferencierOnlyOnce(): void
    {
        $conf = new Conf();
        $conferencier = new Conferencier('Adelaide');
        $conferencier2 = new Conferencier('Charles');
        $conf->addConferencier($conferencier);
        $conf->addConferencier($conferencier2);
        self::assertCount(2, $conf->getConferencier());
    }

    public function testAddMaterielConf(): void
    {
        $conf = new Conf();
        $materiel = new Materiel();
        $materielConf = new Materielconf();

        $materielConf->setMateriel($materiel);
        $conf->addMaterielconf($materielConf);

        self::assertCount(1, $conf->getMaterielconfs());
        self::assertSame($conf, $materielConf->getConf());
        self::assertSame($materiel, $materielConf->getMateriel());
    }
}
