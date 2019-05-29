<?php

namespace App\Repositories;

abstract class Repository 
{
    /**
     * Main repository model
     *
     * @var $model
     */
    protected $model;
    /**
     * Create a new repository instance.
     *
     * @param object $model Main repository model
     */
    public function __construct($model)
    {
        $this->model = $model;
    }
    public function all()
    {
        return  $this->model->all();
    }
    public function orderBy($column)
    {
        return  $this->model->orderBy($column)
        ->get();
    }
    public function create(array $request)
    {
        return  $this->model->create($request);
    }
    public function update($request, $id)
    {
        // $this->model->forget($this->allCacheName);
        $model = $this->model->findOrFail($id);
        return  $model->fill($request->all())->save();
    }
    public function findOrFail($id)
    {
        return  $this->model->findOrFail($id);
    }
    public function insert(array $data)
    {
        return  $this->model->insert($data);
    }
    public function select($value, $id)
    {
        return  $this->model->select($value)->where('id', $id)->first();
    }
    public function insertGetId(array $data)
    {
        $this->model->insert($data);
        return  $this->model->select('id')->latest()->first();
    }
    public function find($id)
    {
        return  $this->model->find($id);
    }
    public function whereIn(array $id)
    {
        return  $this->model->whereIn('id', $id)->get();
    }
    public function getTheLastId()
    {
        $model = $this->model->latest()->first();
        return  $model->id;
    }
    public function clearCache()
    {
        return  $this->model->forget($this->allCacheName);
    }
    public function getNotification()
    {
        return $this->model->whereHas('notification', function($query) {
            $query->where('status', 'unseen');
        })->get();
    }
    public function getModel()
    {
        return  get_class($this->model);
    }
    public function getClassName()
    {
        return  get_class($this->model);
    }

    public function withRelated(array $related)
    {
        return $this->model->with($related)->get();
    }
}