<?php
namespace App\Tests\Unit\Services;

use App\Services\ReservationService;
use App\Services\SoireeReservation;
use PHPUnit\Framework\TestCase;

class ReservationTest extends TestCase 
{
    public function testPrixSansReduction(): void
    {
        $calculator = new ReservationService();
        $resultat = $calculator->calculerPrixTotalConf(5);
        self::assertEquals(60, $resultat);
    }

    public function testPrixAvecReduction(): void
    {
        $calculator = new ReservationService();
        $resultat = $calculator->calculerPrixTotalConf(20);
        self::assertEquals(216, $resultat);
    }

    public function testPrixSansUser(): void
    {
        $calculator = new ReservationService();
        $resultat = $calculator->calculerPrixTotalConf(0);
        self::assertEquals(0, $resultat);
    }

    public function testPrixUserNegatif(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $calculator = new ReservationService();
        $calculator->calculerPrixTotalConf(-30);
    }

}