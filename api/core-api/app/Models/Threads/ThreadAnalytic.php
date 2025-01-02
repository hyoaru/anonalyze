<?php

namespace App\Models\Threads;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ThreadAnalytic extends Model
{
    use HasFactory;

    protected $table = 'thread_analytics';

    protected $fillable = [
        'thread_id',
        'thread_extracted_concept_group_id',
    ];

    public function thread(): BelongsTo
    {
        return $this->belongsTo(Thread::class);
    }

    public function threadExtractedConceptGroup(): BelongsTo
    {
        return $this->belongsTo(ThreadExtractedConceptGroup::class);
    }
}
