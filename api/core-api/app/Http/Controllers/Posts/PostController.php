<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Http\Requests\Posts\Post\StorePostRequest;
use App\Http\Requests\Posts\Post\UpdatePostRequest;
use App\Models\Posts\Post;
use App\Services\PostService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\DB;

class PostController extends Controller implements HasMiddleware
{
    use AuthorizesRequests;

    public static function middleware()
    {
        return [
            new Middleware('auth:sanctum', only: [
                'destroy'
            ])
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        DB::beginTransaction();

        try {
            $validatedData = $request->validated();
            $post = PostService::createPost($validatedData);
            DB::commit();

            $data = ['data' => $post];
            return response()->json($data, 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            abort(400, "Failed to create post. " . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $data = ['data' => PostService::getPostWithRelations($post)];
        return response()->json($data, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();

        $data = ['data' => PostService::getPostWithRelations($post)];
        return response()->json($data, 200);
    }
}
