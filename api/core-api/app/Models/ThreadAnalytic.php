<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    public function threadExtractedConceptGroup(): HasOne
    {
        return $this->hasOne(ThreadExtractedConceptGroup::class);
    }
}
