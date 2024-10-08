<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ThreadExtractedConceptGroup extends Model
{
    use HasFactory;

    protected $table = 'thread_extracted_concept_groups';

    public function threadExtractedConcepts(): HasMany {
        return $this->hasMany(ThreadExtractedConcept::class);
    }

    public function threadAnalytic(): BelongsTo {
        return $this->belongsTo(ThreadAnalytic::class);
    }
}
