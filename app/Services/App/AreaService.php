<?php
namespace App\Services;

use App\Models\Area;

class AreaService
{
    public function getAllAreas()
    {
        return Area::all();
    }

    public function createArea(array $data)
    {
        return Area::create($data);
    }
}
?>
