<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductFormRequest;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productService;

    public function __construct(ProductService $productService) {
        $this->productService = $productService;
    }

    public function index(Request $request): JsonResponse
    {
        return response()->json($this->productService->findAll($request));
    }

    public function show(int $id): JsonResponse
    {
        return response()->json($this->productService->find($id));
    }

    public function store(ProductFormRequest $request): JsonResponse
    {
        return response()->json($this->productService->create($request), 201);
    }

    public function update(ProductFormRequest $request, int $id): JsonResponse
    {
        return response()->json($this->productService->update($request, $id));
    }

    public function destroy(int $id): JsonResponse
    {
        return response()->json($this->productService->delete($id));
    }

}
