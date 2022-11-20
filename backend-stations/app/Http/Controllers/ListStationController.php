<?php

namespace App\Http\Controllers;

use Src\Service\StationService;

class ListStationController
{

    protected StationService $stationService;

    public function __construct(StationService $stationService)
    {
        $this->stationService = $stationService;
    }

    public function __invoke()
    {
        return $this->stationService->list();
    }
}
