<?php

namespace App\Services;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

abstract class AbstractService
{
    protected $model;

    public function findAll(Request $request): Collection {
        $class = get_class($this->model);
        $obj = new $class;

        return $obj->get();
    }

    public function findAllOrderedByName(): ?Collection {
        if ($this->model->offsetExists('name')) {
            return $this->model->orderBy('name')->get();
        }

        return null;
    }

    public function find(int $id): Model {
        if (!$record = $this->model->find($id)) {
            throw new ModelNotFoundException(get_class($this->model) . " with id $id doesn't exists!" );
        }

        return $record;
    }

    public function save(Request $request, int $id = null): Model {

        $class = get_class($this->model);

        if ($id) {

            if (!$this->model = $this->model->find($id)) {
                throw new ModelNotFoundException($class . ' with id $id doesn\'t exists!' );
            }

            if (!$this->model->update($request->all())) {
                throw new \Exception("Fail on update " . $class .
                    " with values: " . collect($request->all())->toJson());
            }

        } else {
            if (!$this->model->fill($request->all())->save()) {
                throw new \Exception("Fail on create " . $class . " with values: "
                    . collect($request->all())->toJson());
            }

        }

        return $this->model;
    }

    public function delete(int $id): Model {
        $class = get_class($this->model);

        if (!$this->model = $this->model->find($id)) {
            throw new ModelNotFoundException($class . ' with id $id doesn\'t exists!' );
        }

        if (!$this->model->delete()) {
            throw new \Exception('Fail on delete ' . $class . " with id $id" );
        }

        return $this->model;
    }
}
