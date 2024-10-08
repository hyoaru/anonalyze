<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PostPredictedEmotion extends Model
{
    use HasFactory;

    protected $table = 'post_predicted_emotions';

    protected $fillable = [
        'emotion_id',
        'probability'
    ];

    public function emotion(): HasOne {
        return $this->hasOne(Emotion::class);
    }

    public function postAnalytic(): BelongsTo {
        return $this->belongsTo(PostAnalytic::class);
    }
}
