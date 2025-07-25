<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use \Illuminate\Database\Eloquent\ModelNotFoundException;

class AdminController extends Controller
{
    public function getPosts(){
        $user = auth()->user();
        $posts = Post::select('id', 'slug', 'title', 'body', 'cover_image', 'status', 'createdAt', 'user_id')
                    ->where('user_id', $user->id)
                    ->with(['user:id,name,email', 'tags:id,name'])
                    ->paginate(10);
        return response()->json($posts, 200);
    }

    public function getPost($slug){
        $user = auth()->user();

        try{
            $post = Post::where(['slug' => $slug, 'user_id' => $user->id])
                    ->with(['user:id,name,email', 'tags:id,name'])
                    ->firstOrFail();
        }catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Post não encontrado', 
                'error' => $e->getMessage(),
                'status' => 404,
                'timestamp' => now()->toDateTimeString(),
            ], 404);
        }
        
        return response()->json($post, 200);
    }

    public function deletePost($slug){
        $user = auth()->user();
        try{
            $post = Post::where(['slug' => $slug, 'user_id' => $user->id])->firstOrFail();
            $post->delete();
        }catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Post não encontrado', 
                'error' => $e->getMessage(),
                'status' => 404,
                'timestamp' => now()->toDateTimeString(),
            ], 404);
        }

        return response()->json(['message' => 'Post deletado com sucesso'], 200);
    }
}
