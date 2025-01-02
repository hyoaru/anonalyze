<?php

namespace App\Services\PostService;

use App\Models\Posts\Post;
use App\Models\Threads\Thread;
use App\Repositories\EmotionRepository\EmotionRepositoryInterface;
use App\Repositories\MachineLearning\EmotionClassificationRepository\EmotionClassificationRepositoryInterface;
use App\Repositories\MachineLearning\SentimentClassificationRepository\SentimentClassificationRepositoryInterface;
use App\Repositories\PostAnalyticRepository\PostAnalyticRepositoryInterface;
use App\Repositories\PostPredictedEmotionRepository\PostPredictedEmotionRepositoryInterface;
use App\Repositories\PostPredictedSentimentRepository\PostPredictedSentimentRepositoryInterface;
use App\Repositories\PostRepository\PostRepositoryInterface;
use App\Repositories\SentimentRepository\SentimentRepositoryInterface;
use App\Repositories\ThreadRepository\ThreadRepositoryInterface;

class PostService implements PostServiceInterface
{
    protected PostRepositoryInterface $postRepository;

    protected SentimentClassificationRepositoryInterface $sentimentClassificationRepository;

    protected EmotionClassificationRepositoryInterface $emotionClassificationRepository;

    protected SentimentRepositoryInterface $sentimentRepository;

    protected EmotionRepositoryInterface $emotionRepository;

    protected PostPredictedSentimentRepositoryInterface $postPredictedSentimentRepository;

    protected PostPredictedEmotionRepositoryInterface $postPredictedEmotionRepository;

    protected PostAnalyticRepositoryInterface $postAnalyticRepository;

    protected ThreadRepositoryInterface $threadRepository;

    public function __construct(
        PostRepositoryInterface $postRepository,
        SentimentClassificationRepositoryInterface $sentimentClassificationRepository,
        EmotionClassificationRepositoryInterface $emotionClassificationRepository,
        SentimentRepositoryInterface $sentimentRepository,
        EmotionRepositoryInterface $emotionRepository,
        PostPredictedSentimentRepositoryInterface $postPredictedSentimentRepository,
        PostPredictedEmotionRepositoryInterface $postPredictedEmotionRepository,
        PostAnalyticRepositoryInterface $postAnalyticRepository,
        ThreadRepositoryInterface $threadRepository,
    ) {
        $this->postRepository = $postRepository;
        $this->sentimentClassificationRepository = $sentimentClassificationRepository;
        $this->emotionClassificationRepository = $emotionClassificationRepository;
        $this->sentimentRepository = $sentimentRepository;
        $this->emotionRepository = $emotionRepository;
        $this->postPredictedSentimentRepository = $postPredictedSentimentRepository;
        $this->postPredictedEmotionRepository = $postPredictedEmotionRepository;
        $this->postAnalyticRepository = $postAnalyticRepository;
        $this->threadRepository = $threadRepository;
    }

    public function new(Thread $thread, array $postParams): Post
    {
        // Create new post and associate its author
        $post = $this->postRepository->new($postParams);
        $post->thread()->associate($thread);
        $post->save();

        /*
        * [ Sentiment prediction process block ]
        * 1. Predict sentiment
        * 2. Get the sentiment record from predicted sentiment class
        * 3. Create a new post predicted sentiment record
        */
        $predictedSentiment = $this->sentimentClassificationRepository->classify($post->content);
        $sentiment = $this->sentimentRepository->getByClass($predictedSentiment['class']);

        $postPredictedSentiment = $this->postPredictedSentimentRepository->new([
            'probability' => $predictedSentiment['probability'],
        ]);
        $postPredictedSentiment->sentiment_id = $sentiment->id;
        $postPredictedSentiment->save();

        /*
        * [ Emotion prediction process block ]
        * 1. Predict emotion
        * 2. Get the emotion record from predicted emotion class
        * 3. Create a new post predicted emotion record
        */
        $predictedEmotion = $this->emotionClassificationRepository->classify($post->content);
        $emotion = $this->emotionRepository->getByClass($predictedEmotion['class']);

        $postPredictedEmotion = $this->postPredictedEmotionRepository->new([
            'probability' => $predictedEmotion['probability'],
        ]);
        $postPredictedEmotion->emotion_id = $emotion->id;
        $postPredictedEmotion->save();

        // Create new post analytic
        $postAnalytic = $this->postAnalyticRepository->new();

        // Associate post and predictions
        $postAnalytic->post_id = $post->id;
        $postAnalytic->post_predicted_sentiment_id = $postPredictedSentiment->id;
        $postAnalytic->post_predicted_emotion_id = $postPredictedEmotion->id;
        $postAnalytic->save();

        return $post;
    }
}
