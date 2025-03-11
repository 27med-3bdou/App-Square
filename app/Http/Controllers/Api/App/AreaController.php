<?php

namespace App\Http\Controllers\Api\App;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\App\AreaRequest;
use App\Services\AreaService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function __construct(private AreaService $areaService)
    {
        $this->areaService = $areaService;
    }

    public function index(): JsonResponse
    {
        $areas = $this->areaService->getAllAreas();
        return response()->json(['areas' => $areas], 200);
    }

    public function store(AreaRequest $request): JsonResponse
    {
        $area = $this->areaService->createArea($request->validated());
        return response()->json([
            'message' => 'Area created successfully',
            'area' => $area
        ], 201);
    }
}
