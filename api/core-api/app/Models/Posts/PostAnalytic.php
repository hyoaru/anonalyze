<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PostAnalytic extends Model
{
    use HasFactory;

    protected $table = 'post_analytics';

    protected $fillable = [
        'post_id',
        'post_predicted_sentiment_id',
        'post_predicted_emotion_id',
    ];

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    public function postPredictedSentiment(): BelongsTo
    {
        return $this->belongsTo(PostPredictedSentiment::class);
    }

    public function postPredictedEmotion(): BelongsTo
    {
        return $this->belongsTo(PostPredictedEmotion::class);
    }
}
