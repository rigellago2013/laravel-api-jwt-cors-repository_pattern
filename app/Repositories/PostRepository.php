<?php

namespace App\Repositories;

use App\Post;
use App\Repositories\Repository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

class PostRepository extends Repository
{
    public function __construct(Post $model)
    {
        parent::__construct($model);
    }

    
}