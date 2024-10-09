<?php

namespace App\Models\Posts;

use App\Models\Threads\Thread;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'thread_id',
        'content'
    ];

    public function thread(): BelongsTo
    {
        return $this->belongsTo(Thread::class);
    }

    public function postAnalytic(): HasOne
    {
        return $this->hasOne(PostAnalytic::class);
    }
}
