<?php

namespace App\Models\Posts;

use App\Models\Emotion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PostPredictedEmotion extends Model
{
    use HasFactory;

    protected $table = 'post_predicted_emotions';

    protected $fillable = [
        'emotion_id',
        'probability',
    ];

    public function emotion(): HasOne
    {
        return $this->hasOne(Emotion::class, 'id', 'emotion_id');
    }

    public function postAnalytic(): HasOne
    {
        return $this->hasOne(PostAnalytic::class);
    }
}
