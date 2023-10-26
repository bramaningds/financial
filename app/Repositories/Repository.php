<?php

namespace App\Repositories;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\Model;

abstract class Repository
{

    protected $model;
    protected $with = [];
    protected $paginate = false;
    protected $perPage = 10;

    public function __construct()
    {
        $this->model = $this->model ?? 'App\\Models\\' . str_replace([__NAMESPACE__, 'Repository', '\\'], '', get_class($this));
    }

    public function browse(array $params = [])
    {
        // make new query model
        $query = $this->model::query();

        // set the 'with' query
        $this->with && all_method_exists($this->model, $this->with) && $query->with($this->with);

        // apply search
        method_exists($this->model, 'scopeSearch') && $query->search($params['keyword'] ?? null);

        // apply filter
        method_exists($this->model, 'scopeFilter') && $query->filter($this->model::getFilters($params));

        return $this->paginate
            ? $query->paginate($params['per_page'] ?? $this->perPage)->withQueryString()
            : $query->get();
    }

    public function find($id)
    {
        return $this->model::findOrFail($id);
    }

    public function store(array $attributes)
    {
        $model = new $this->model;
        $model->fill(array_filter_key($attributes, $model->getFillable()));
        $model->save() || throw new Exception('Cannot store new model.');

        return $model;
    }

    public function update($id, array $attributes)
    {
        $model = $id instanceof Model ? $id : $this->find($id);
        $model->fill(array_filter_key($attributes, $model->getFillable()));
        $model->save() || throw new Exception('Cannot update model.');

        return $model;
    }

    public function delete($id)
    {
        $model = $id instanceof Model ? $id : $this->find($id);
        $model->delete() || throw new Exception('Cannot delete model.');

        return true;
    }
}
