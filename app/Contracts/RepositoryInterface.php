<?php

namespace App\Contracts;
/**
 * The RepositoryInterface contains ONLY method signatures for methods
 * related to the Repository object.
 *
 * Note that we extend from RepositoryInterface, so any class that implements
 * this interface must also provide all the standard eloquent methods (find, all, etc.)
 */

interface RepositoryInterface
{
    public function all();
    public function create($request);
    public function update($request, $id);
    public function findOrFail($id);
    public function select($value, $id);
    public function insert(array $data);
    public function insertGetId(array $data);
    public function find($id);
    public function whereIn(array $id);
    public function orderBy($column);
    public function getTheLastId();
    public function clearCache();
    public function getNotification();
    public function getModel();
    public function getClassName();
    public function with(array $related);
}