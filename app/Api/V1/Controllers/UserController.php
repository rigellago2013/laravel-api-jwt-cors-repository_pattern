<?php

namespace App\Api\V1\Controllers;

use Symfony\Component\HttpKernel\Exception\HttpException;
use Tymon\JWTAuth\JWTAuth;
use App\Http\Controllers\Controller;
use App\Api\V1\Requests\LoginRequest;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Auth;
use App\Repositories\UserRepository;

class UserController extends Controller
{
    protected $entity;
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(UserRepository $user)
    {
        $this->entity = $user;
        $this->middleware('jwt.auth', []);
    }

    /**
     * Get the authenticated User
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(Auth::guard()->user());
    }

    public function index()
    {
        $users =  $this->entity->all();
        return response()->json(['data' => $users], 200);
    }
}