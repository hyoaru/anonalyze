<?php

namespace App\Services;

use App\Models\Emotion;
use App\Models\Posts\Post;
use App\Models\Posts\PostPredictedEmotion;
use App\Models\Posts\PostPredictedSentiment;
use App\Models\Sentiment;
use Exception;

class PostService
{
    public static function createPost(array $validatedData)
    {
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

        $data = self::getPostWithRelations($post);

        return $data;
    }

    public static function getPostWithRelations($post)
    {
        if (!$post instanceof Post) {
            $post = Post::findOrFail($post);
        }

        $data = $post->load([
            'postAnalytic',
            'postAnalytic.postPredictedSentiment',
            'postAnalytic.postPredictedSentiment.sentiment',
            'postAnalytic.postPredictedEmotion',
            'postAnalytic.postPredictedEmotion.emotion',
        ]);

        return $data;
    }
}
