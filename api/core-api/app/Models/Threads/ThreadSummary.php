<?php

namespace App\Models\Threads;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ThreadSummary extends Model
{
    use HasFactory;

    protected $table = 'thread_summaries';

    protected $fillable = [
        'thread_id',
        'summary'
    ];


    public function thread(): BelongsTo
    {
        return $this->belongsTo(Thread::class);
    }
}
