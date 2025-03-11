<?php

namespace App\Services;

use App\Models\Zone;

class ZoneService
{
    public function getAllZones()
    {
        return Zone::all();
    }

    public function createZone(array $data)
    {
        return Zone::create($data);
    }

    public function getZoneById($id)
    {
        return Zone::findOrFail($id);
    }
}
