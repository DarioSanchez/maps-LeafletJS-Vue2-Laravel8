<?php

namespace App\Http\Controllers;

use Src\Service\StationService;
use Illuminate\Http\Request;


class DetailStationController
{

    protected StationService $stationService;

    public function __construct(StationService $stationService)
    {
        $this->stationService = $stationService;
    }

    public function __invoke(Request $request)
    {
        return $this->stationService->detail($request->id);
    }
}
