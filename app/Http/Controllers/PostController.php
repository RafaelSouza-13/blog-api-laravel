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
        $tagsIds = $post->tags->pluck('id')->toArray();
        $relatedPosts = Post::select('posts.id', 'slug', 'title', 'body', 'cover_image', 'user_id')
            ->where('posts.id', '!=', $post->id)
            ->join('posts_tags', 'posts.id', '=', 'posts_tags.post_id')
            ->whereIn('posts_tags.tag_id', $tagsIds)
            ->groupBy('posts.id', 'slug', 'title', 'body', 'cover_image', 'user_id')
            ->orderByRaw('COUNT(posts_tags.tag_id) DESC')
            ->with(['user:id,name,email', 'tags:id,name'])
            ->paginate(3);
        return response()->json($relatedPosts, 200);
    }
}
