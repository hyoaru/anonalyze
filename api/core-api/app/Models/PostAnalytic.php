<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PostAnalytic extends Model
{
    use HasFactory;

    protected $table = 'post_analytics';

    protected $fillable = [
        'post_id',
        'post_predicted_sentiment_id',
        'post_predicted_emotion_id',
    ];

    public function post(): BelongsTo {
        return $this->belongsTo(Post::class);
    }

    public function postPredictedSentiment(): HasOne {
        return $this->hasOne(PostPredictedSentiment::class, 'id', 'post_predicted_sentiment_id');
    }

    public function postPredictedEmotion(): HasOne {
        return $this->hasOne(PostPredictedEmotion::class, 'id', 'post_predicted_emotion_id');
    }
}
