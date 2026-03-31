<?php

namespace App\Services;

class ReservationService
{
    public function calculerPrixTotalConf(int $nbPersonnes): int
    {
        if ($nbPersonnes < 0) {
            throw new \InvalidArgumentException('Vous ne ppouvez pas mettre un nombre négatif');
        }

        $prix = $nbPersonnes * 12;

        if ($nbPersonnes > 10) {
            $prix *= 0.9; // -10%
        }

        return $prix;
    }
}
