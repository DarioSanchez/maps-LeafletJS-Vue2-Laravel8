<?php

namespace Src\Service;


use Src\Domains\Repository\StationsRepository;
use Src\StationStrategyInterface;


class StationService implements StationStrategyInterface
{

    public StationsRepository $stationsRepository;

    public function __construct(StationsRepository $stationsRepository)
    {
        $this->stationsRepository = $stationsRepository;
    }

    public function list()
    {
        return $this->stationsRepository->list();
    }

    public function detail($id)
    {
        return $this->stationsRepository->detail($id);
    }

    public function localizations()
    {
        return $this->stationsRepository->localizations();
    }

    public function listAll()
    {
        return $this->stationsRepository->listAll();
    }

    public function getLocalizations($id)
    {
        return $this->stationsRepository->getLocalizations($id);
    }
}
