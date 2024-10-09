<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Http\Requests\Posts\PostTransaction\CreatePostTransactionRequest;
use App\Services\PostService;
use Illuminate\Support\Facades\DB;

class PostTransactionController extends Controller
{
    public function createPost(CreatePostTransactionRequest $request)
    {
        DB::beginTransaction();

        try {
            $validatedData = $request->validated();
            $response = PostService::createPost($validatedData);

            DB::commit();
            return $response;

        } catch (\Throwable $th) {
            DB::rollBack();
            abort(400, "Failed to create post. " . $th->getMessage());
        }
    }
}
