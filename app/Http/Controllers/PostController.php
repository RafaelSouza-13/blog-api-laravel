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
                    ->paginate(10);
        
        
        return response()->json($posts, 200);
    }

    public function getPost($slug){
        $post = Post::where('slug', $slug)
                    ->with(['user:id,name,email', 'tags:name'])
                    ->firstOrFail();
        if (!$post) {
            return response()->json(['message' => 'Post não encontrado'], 404);
        }
        return response()->json($post, 200);
    }
}
