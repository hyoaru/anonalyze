<?php

namespace Database\Seeders;

use App\Models\Emotion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Emotion::create([
            'id' => 1,
            'class' => 'sadness',
            'description' => 'Words that convey negative emotions, loss, disappointment, or grief. It looks for keywords and phrases associated with sorrow and emotional pain, such as "regret," "lonely," or "unhappy."'
        ]);
        
        Emotion::create([
            'id' => 2,
            'class' => 'joy',
            'description' => 'Positive language and expressions of happiness, contentment, and excitement. It focuses on terms like "happy," "delight," "celebrate," and "pleased" to evaluate joyful sentiments.'
        ]);
        
        Emotion::create([
            'id' => 3,
            'class' => 'love',
            'description' => 'Words and phrases related to affection, care, and strong positive connections. It evaluates terms like "adore," "cherish," "beloved," or "affection" to determine if the sentiment expresses love.'
        ]);
        
        Emotion::create([
            'id' => 4,
            'class' => 'anger',
            'description' => 'Aggressive or harsh language, frustration, or expressions of discontent. It looks for keywords like "furious," "mad," "irritated," or "hate" to classify anger.'
        ]);
        
        Emotion::create([
            'id' => 5,
            'class' => 'fear',
            'description' => 'Language associated with anxiety, threat, or concern. It analyzes words like "scared," "nervous," "panic," or "worried" to predict the sentiment of fear.'
        ]);
        
        Emotion::create([
            'id' => 6,
            'class' => 'surprised',
            'description' => 'Unexpectedness or shock in the text. It focuses on words and phrases like "amazed," "shocked," "unexpected," or "astonished" to classify surprise.'
        ]);
    }
}
