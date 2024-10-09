<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostTransactions\CreatePostTransactionRequest;
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

            DB::rollBack();
            return $response;

        } catch (\Throwable $th) {
            DB::rollBack();
            abort(400, "Failed to create post. " . $th->getMessage());
        }
    }
}
