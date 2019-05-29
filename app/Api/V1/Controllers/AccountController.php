<?php

namespace App\Api\V1\Controllers;

use App\Http\Controllers\Controller;
use Auth;
use App\Repositories\AccountRepository;

class AccountController extends Controller
{
    protected $entity;

    public function __construct(AccountRepository $account)
    {
        $this->entity = $account;
    }

    public function index()
    {
        $data =  $this->entity->all();
        return response()->json(['data' => $data], 200);
    }
}
