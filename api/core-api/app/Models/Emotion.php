<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Emotion extends Model
{
    use HasFactory;

    protected $table = 'emotions';

    public function postPredictedEmotions(): HasMany {
        return $this->hasMany(Emotion::class, 'emotion_id');
    }
}
