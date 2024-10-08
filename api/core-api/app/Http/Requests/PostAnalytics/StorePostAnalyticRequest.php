<?php

namespace App\Http\Requests\PostAnalytics;

use Illuminate\Foundation\Http\FormRequest;

class StorePostAnalyticRequest extends FormRequest
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
            'post_id' => 'required:exists:posts,id',
            'post_predicted_sentiment_id' => 'required|exists:post_predicted_sentiments,id',
            'post_predicted_emotion_id' => 'required|exists:post_predicted_emotions,id',
        ];
    }
}
