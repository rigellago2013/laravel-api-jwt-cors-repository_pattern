<?php

namespace App\Repositories;

use App\User;
use App\Contracts\RepositoryInterface;
use App\Repositories\Repository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

class UserRepository extends Repository implements RepositoryInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }
}