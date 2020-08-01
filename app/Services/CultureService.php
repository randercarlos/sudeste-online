<?php

namespace App\Services;

use App\Models\Culture;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

class CultureService extends AbstractService
{
    protected $model;

    public function __construct() {
        $this->model = new Culture();
    }

    public function findAll(Request $request): Collection {

        $query = Culture::query();
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
