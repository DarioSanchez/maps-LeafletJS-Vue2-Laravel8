<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Src\Service\StationService;

class LocalizationIdStationController
{

    protected StationService $stationService;

    public function __construct(StationService $stationService)
    {
        $this->stationService = $stationService;
    }

    public function __invoke(Request $request)
    {
        return $this->stationService->getLocalizations($request->id);
    }
}
