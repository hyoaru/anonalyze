<?php

namespace App\Http\Requests\Threads\ThreadExtractedConcept;

use Illuminate\Foundation\Http\FormRequest;

class StoreThreadExtractedConceptRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'thread_extracted_concept_group_id' => 'required|exists:thread_extracted_concept_groups,id',
            'concept' => 'required|string|max:64',
            'significance_score' => 'required|numeric|between:0,1'
        ];
    }
}
