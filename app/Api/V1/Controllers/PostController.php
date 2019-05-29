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
        $data = $user
            ->posts()
            ->orderBy('created_at', 'DESC')
            ->get();

        return response()->json(['data' => $data], 200);
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
            return response()->json(['message' => 'success'], 200);
        else
            return response()->json(['message' => 'error creating post.'], 500);
    }
}
