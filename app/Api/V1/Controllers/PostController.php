<?php

namespace App\Api\V1\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
use App\Post;
use Dingo\Api\Routing\Helpers;
use App\Repositories\PostRepository;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    use Helpers;

    protected $post;

    public function __construct(PostRepository $post)
    {
        $this->post = $post;
    }

    public function index()
    {
        $user = JWTAuth::parseToken()->authenticate();
        return $user
            ->posts()
            ->orderBy('created_at', 'DESC')
            ->get();
    }


    public function store(Request $request)
    {
         $currentUser = JWTAuth::parseToken()->authenticate();

        $data =  [
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => $currentUser->id
        ];

        if($this->post->create($data))
            return $this->response->created();
        else
            return $this->response->error('could_not_create_book', 500);
    }
}
