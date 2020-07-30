<?php

namespace App\Http\Controllers;

use App\Http\Requests\PragueFormRequest;
use App\Services\PragueService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PragueController extends Controller
{
    private $pragueService;

    public function __construct(PragueService $pragueService) {
        $this->pragueService = $pragueService;
    }

    public function index(Request $request): JsonResponse
    {
        return response()->json($this->pragueService->findAll($request));
    }

    public function show(int $id): JsonResponse
    {
        return response()->json($this->pragueService->find($id));
    }

    public function store(PragueFormRequest $request): JsonResponse
    {
        return response()->json($this->pragueService->save($request), 201);
    }

    public function update(PragueFormRequest $request, int $id): JsonResponse
    {
        return response()->json($this->pragueService->save($request, $id));
    }

    public function destroy(int $id): JsonResponse
    {
        return response()->json($this->pragueService->delete($id));
    }

}
