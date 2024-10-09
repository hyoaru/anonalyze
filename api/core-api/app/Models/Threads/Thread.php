<?php

namespace App\Models\Threads;

use App\Models\Posts\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Thread extends Model
{
    use HasFactory;

    protected $table = 'threads';

    protected $fillable = [
        'user_id',
        'question'
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function threadSummary(): HasOne
    {
        return $this->hasOne(ThreadSummary::class);
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function threadAnalytic(): HasOne
    {
        return $this->hasOne(ThreadAnalytic::class, 'thread_id', 'id');
    }
}
