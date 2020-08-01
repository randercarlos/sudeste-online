<?php

namespace App\Services;

use App\Models\Prague;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class PragueService extends AbstractService
{
    protected $model;

    public function __construct() {
        $this->model = new Prague();
    }

    public function findAll(Request $request): Collection {

        $query = Prague::query();
        $query = $this->buildFilters($query, $request);

        return $query->get();
    }

    private function buildFilters(Builder $query, Request $request): Builder {

        $query->when($request->query('name'), function ($q) use ($request) {
            return $q->where('name', 'like', '%' . $request->query('name') . '%');
        });

        $query->when($request->filled('sort') && $this->model->offsetExists($request->query('sort')),
            function ($q) use ($request) {
                return $q->orderBy($request->query('sort'),
                    $request->query('order', 'asc') === 'asc' ? 'asc' : 'desc');
            });

        return $query;
    }
}
