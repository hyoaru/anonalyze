<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostTransactions\CreatePostTransactionRequest;
use App\Models\Emotion;
use App\Models\Post;
use App\Models\PostPredictedEmotion;
use App\Models\PostPredictedSentiment;
use App\Models\Sentiment;
use App\Services\MlApiService;
use Exception;
use Illuminate\Support\Facades\DB;

class PostTransactionController extends Controller
{
    public function createPost(CreatePostTransactionRequest $request)
    {
        DB::beginTransaction();

        try {
            $validatedData = $request->validated();

            $mlApiPredictedSentimentResponse = MlApiService::predictSentiment($validatedData['content']);
            throw_if(!$mlApiPredictedSentimentResponse->successful(), new Exception("An error has occured in predicting sentiment."));
            $mlApiPredictedSentimentResponseJson = $mlApiPredictedSentimentResponse->json();

            $mlApiPredictedEmotionResponse = MlApiService::predictEmotion($validatedData['content']);
            throw_if(!$mlApiPredictedEmotionResponse->successful(), new Exception("An error has occured in predicting emotion."));
            $mlApiPredictedEmotionResponseJson = $mlApiPredictedEmotionResponse->json();

            $post = Post::create($validatedData);
            $sentiment = Sentiment::where('class', $mlApiPredictedSentimentResponseJson['data']['predicted_value']['class'])->firstOrFail();
            $emotion = Emotion::where('class', $mlApiPredictedEmotionResponseJson['data']['predicted_value']['class'])->firstOrFail();

            $postPredictedSentiment = PostPredictedSentiment::create([
                'sentiment_id' => $sentiment->id,
                'probability' => $mlApiPredictedSentimentResponse['data']['predicted_value']['probability'],
            ]);

            $postPredictedEmotion = PostPredictedEmotion::create([
                'emotion_id' => $emotion->id,
                'probability' => $mlApiPredictedEmotionResponse['data']['predicted_value']['probability'],
            ]);

            $postAnalytic = $post->postAnalytic()->create([
                'post_predicted_sentiment_id' => $postPredictedSentiment->id,
                'post_predicted_emotion_id' => $postPredictedEmotion->id,
            ]);

            DB::commit();

            $response = ['data' => $post->load([
                'postAnalytic', 
                'postAnalytic.postPredictedSentiment', 
                'postAnalytic.postPredictedEmotion'
            ])];

            return response()->json($response, 201);

        } catch (\Throwable $th) {
            DB::rollBack();
            abort(400, "Failed to create post. " . $th->getMessage());
        }
    }
}
