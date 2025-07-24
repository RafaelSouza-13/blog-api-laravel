<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function findAll()
    {
        $posts = Post::select('id', 'slug', 'title', 'body', 'cover_image', 'createdAt', 'user_id')
                    ->with(['user:id,name,email', 'tags:name'])
                    ->get();
        
        // $posts = Post::with('user')->get();
        return response()->json($posts, 200);

    }
}
