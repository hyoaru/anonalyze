<?php

namespace App\Models\Threads;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ThreadExtractedConceptGroup extends Model
{
    use HasFactory;

    protected $table = 'thread_extracted_concept_groups';

    public function threadExtractedConcepts(): HasMany
    {
        return $this->hasMany(ThreadExtractedConcept::class);
    }

    public function threadAnalytic(): HasOne
    {
        return $this->hasOne(ThreadAnalytic::class);
    }
}
