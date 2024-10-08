<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ThreadExtractedConcept extends Model
{
    use HasFactory;

    protected $table = 'thread_extracted_concepts';

    protected $fillable = [
        'thread_extracted_concept_group_id',
        'concept',
        'significance_score'
    ];

    public function threadExtractedConceptGroup(): BelongsTo {
        return $this->belongsTo(ThreadExtractedConceptGroup::class);
    }
}
