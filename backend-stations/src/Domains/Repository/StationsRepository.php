<?php

namespace Src\Domains\Repository;

use App\Models\Station;

class StationsRepository
{
    public function listAll()
    {
        return Station::all();
    }

    public function list()
    {
       return collect(Station::select('name')->get())->pluck('name');
    }

    public function detail(int $id)
    {
        return Station::find($id);
    }

    public function localizations()
    {
        $units = Station::select('lat', 'lng','name','owner','address')->take(40)->get();

        foreach ($units as $data) {

            $arr[] = [
                'displayInfo' => false,
                'lat' => $data->lat,
                'lng' =>  $data->lng,
                'name' => $data->name,
                'owner' => $data->owner,
                'address' =>  $data->address,
            ];
        }
        return $arr;
    }

    public function getLocalizations(int $id)
    {
        return Station::select('lat', 'lng')->whereId($id)->first();
    }
}
