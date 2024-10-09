<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sentiment extends Model
{
    use HasFactory;

    protected $table = 'sentiments';

    public function postPredictedSentiments(): HasMany {
        return $this->hasMany(PostPredictedSentiment::class, 'sentiment_id');
    }
}
