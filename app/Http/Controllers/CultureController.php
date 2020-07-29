<?php

namespace App\Http\Controllers;

use App\Http\Requests\CultureFormRequest;
use App\Services\CultureService;
use Illuminate\Http\Request;

class CultureController extends Controller
{
    private $cultureService;

    public function __construct(CultureService $cultureService) {
        $this->cultureService = $cultureService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return response()->json($this->cultureService->findAll($request));
    }

    public function show(int $id)
    {
        return response()->json($this->cultureService->find($id));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CultureFormRequest $request)
    {
        return response()->json($this->cultureService->create($request), 201);
    }

    public function update(CultureFormRequest $request, int $id)
    {
        return response()->json($this->cultureService->update($request, $id));
    }

    public function destroy(int $id)
    {
        return response()->json($this->cultureService->delete($id));
    }

}
