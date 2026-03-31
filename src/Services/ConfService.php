<?php

namespace App\Services;

use App\Repository\ConfRepository;

class ConfService
{
    private ConfRepository $confRepository;

    public function __construct(ConfRepository $confRepository)
    {
        $this->confRepository = $confRepository;
    }

    /** @return \App\Entity\Conf[] */
    public function getConfListCount(): array
    {
        return $this->confRepository->findByListCount();
    }
}
