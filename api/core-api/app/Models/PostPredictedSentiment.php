<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PostPredictedSentiment extends Model
{
    use HasFactory;

    protected $table = 'post_predicted_sentiments';

    protected $fillable = [
        'sentiment_id',
        'probability'
    ];

    public function sentiment(): HasOne {
        return $this->hasOne(Sentiment::class);
    }
}
