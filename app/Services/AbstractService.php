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

        if ($id) {
            if (!$record = $this->model->find($id)) {
                throw new \Exception(get_class($this->model) . ' with id ' . $id . ' doesn\'t exists!');
            }

            if (!$record->update($request->all())) {
                throw new \Exception("Fail on update " . get_class($this->model) . " with values: " . $request->all());
            }
        } else {
            if (!$this->model->fill($request->all())->save()) {
                throw new \Exception("Fail on create " . get_class($this->model) . " with values: " . $request->all());
            }
        }

        return $this->model;
    }

    public function delete(int $id): bool {
        if (!$this->model->find($id)) {
            throw new \Exception("{ get_class($this->model) } with id $id doesn\'t exists!" );
        }

        if (!$this->model->delete()) {
            throw new \Exception("Fail on delete { get_class($this->model) } with id $id" );
        }

        return true;
    }
}
