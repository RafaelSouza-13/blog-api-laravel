<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function findAll()
    {
        $posts = Post::select('id', 'slug', 'title', 'body', 'cover_image', 'createdAt', 'user_id')
                    ->with(['user:id,name,email', 'tags:id,name'])
                    ->paginate(10);
        return response()->json($posts, 200);
    }

    public function getPost($slug){
        $post = Post::where('slug', $slug)
                    ->with(['user:id,name,email', 'tags:id,name'])
                    ->firstOrFail();
        if (!$post) {
            return response()->json(['message' => 'Post não encontrado'], 404);
        }
        return response()->json($post, 200);
    }

    public function getRelatedPosts($slug){
        $post = Post::where('slug', $slug)
                    ->with(['user:id,name,email', 'tags:id,name'])
                    ->firstOrFail();

        if (!$post) {
            return response()->json(['message' => 'Post não encontrado'], 404);
        }

        $relatedPosts = Post::where('id', '!=', $post->id)
                            ->whereHas('tags', function($query) use ($post) {
                                $query->whereIn('id', $post->tags->pluck('id'));
                            })
                            ->with(['user:id,name,email', 'tags:name'])->paginate(3);

        return response()->json($relatedPosts, 200);
    }
}
