<?php

namespace App\Http\Requests\Posts\PostPredictedSentiment;

use Illuminate\Foundation\Http\FormRequest;

class StorePostPredictedSentimentRequest extends FormRequest
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
            'sentiment_id' => 'required|exists:sentiments,id',
            'probability' => 'required|numeric|between:0,1'
        ];
    }
}
