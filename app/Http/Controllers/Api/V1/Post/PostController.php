<?php


namespace App\Http\Controllers\Api\V1\Post;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $post = Post::all();
        return response()->json([
            'status' => 'successfully',
            'post' =>$post
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $post = new Post();
        $post->title = $request->title;
        $post->description = $request->description;
        $post->category_id = $request->category_id;
        $post->save();
        return response()->json([
            'status' => 'create post successfully',
            'post' => $post
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show( string $id)
    {
        $post = Post::find($id);
        if (!$post) {
            return response()->json(['message ' => 'Not found post'], 404);
        }
        return response()->json([
            'status' => ' successfully',
            'post' => new  PostResource($post) 
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::find($id);
        if (!$post) {
            return response()->json(['message ' => 'Not found post'], 404);
        }
        $post->title = $request->title ?? $post->title;
        $post->description = $request->description ?? $post->description;
        $post->category_id = $request->category_id ?? $post->category_id;
        $post->save();
        return response()->json([
            'status' => 'Update post successfully',
            'post' => $post
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::find($id);
        if (!$post) {
            return response()->json(['message ' => 'Not found post'], 404);
        }
        $post->delete();
        return response()->json([
            'status' => ' delete post successfully',
        ]);
    }
}
