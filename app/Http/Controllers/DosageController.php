<?php

namespace App\Http\Controllers;

use App\Http\Requests\DosageFormRequest;
use App\Services\DosageService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DosageController extends Controller
{
    private $dosageService;

    public function __construct(DosageService $dosageService) {
        $this->dosageService = $dosageService;
    }

    public function index(Request $request): JsonResponse
    {
        return response()->json($this->dosageService->findAll($request));
    }

    public function show(int $id): JsonResponse
    {
        return response()->json($this->dosageService->find($id));
    }

    public function store(DosageFormRequest $request): JsonResponse
    {
        return response()->json($this->dosageService->save($request), 201);
    }

    public function update(DosageFormRequest $request, int $id): JsonResponse
    {
        return response()->json($this->dosageService->save($request, $id));
    }

    public function destroy(int $id): JsonResponse
    {
        return response()->json($this->dosageService->delete($id));
    }

}
