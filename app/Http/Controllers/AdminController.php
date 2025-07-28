<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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

    public function createPost(PostRequest $request){
        $data = $request->validated();
        $post = new Post();
        $post->title = $data['title'];
        $post->body = $data['body'];
        $post->user_id = auth()->id();
        $post->slug = $this->generateSlug($data['title']);
        if($request->hasFile('cover_image')){
            $file = $request->file('cover_image');
            $originalName = $file->getClientOriginalName();
            $filename = pathinfo($originalName, PATHINFO_FILENAME) . '-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/covers'), $filename);
            $post->cover_image = env('APP_URL') . '/uploads/covers/' . $filename;
        }
        if(isset($data['status'])) {
            $post->status = $data['status'];
        }
        $post->updatedAt = now();
        $post->save();

        if(isset($data['tags'])) {
            $post->tags()->sync($data['tags']);
        }
        $post->load(['user:id,name,email', 'tags:id,name']);
        return response()->json(['post' => $post], 201);
    }

    public function generateSlug($title){
        $slug = Str::slug($title). '-' . time();
        return $slug;
    }   
}
