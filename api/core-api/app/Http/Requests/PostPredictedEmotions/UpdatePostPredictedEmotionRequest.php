<?php

namespace App\Http\Requests\PostPredictedEmotions;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostPredictedEmotionRequest extends FormRequest
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
            'emotion_id' => 'required|exists:emotions,id',
            'probability' => 'required|numeric|between:0,1'
        ];
    }
}