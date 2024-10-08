<?php

namespace App\Http\Requests\ThreadAnalytics;

use Illuminate\Foundation\Http\FormRequest;

class StoreThreadAnalyticRequest extends FormRequest
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
            'thread_id' => 'required|exists:threads,id',
            'thread_extracted_concept_group_id' => 'required|exists,thread_extracted_concept_groups,id'
        ];
    }
}
