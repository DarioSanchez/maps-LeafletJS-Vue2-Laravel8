<?php

namespace App\Http\Controllers;

use Src\Service\StationService;
use Illuminate\Database\Eloquent\Collection;

class ListAllStationController
{

    protected StationService $stationService;

    public function __construct(StationService $stationService)
    {
        $this->stationService = $stationService;
    }

    public function __invoke(): Collection
    {
        return $this->stationService->listAll();
    }
}
