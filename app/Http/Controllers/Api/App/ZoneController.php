<?php

namespace App\Http\Controllers\Api\App;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\App\ZoneRequest;
use App\Services\ZoneService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ZoneController extends Controller
{
    // public function index()
    // {
    //     return 'zone';
    // }

    public function __construct(private ZoneService $zoneService)
    {
        $this->zoneService = $zoneService;
    }

    public function index(): JsonResponse
    {
        $zones = $this->zoneService->getAllZones();
        return response()->json(['zones' => $zones], 200);
    }

    public function store(ZoneRequest $request): JsonResponse
    {
        $zone = $this->zoneService->createZone($request->validated());
        return response()->json([
            'message' => 'Zone created successfully',
            'zone' => $zone
        ], 201);
    }

    public function show($id): JsonResponse
    {
        $zone = $this->zoneService->getZoneById($id);
        return response()->json(['zone' => $zone], 200);
    }
}
