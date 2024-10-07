<?php

namespace Database\Seeders;

use App\Models\Sentiment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SentimentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sentiment::firstOrCreate([
            'id' => 1,
            'class' => 'negative',
            'description' => 'Expressions of discontent, sadness, or hostility. It identifies words that convey criticism, dissatisfaction, or adverse feelings, such as "bad," "terrible," or "unhappy."'
        ]);
        
        Sentiment::firstOrCreate([
            'id' => 2,
            'class' => 'positive',
            'description' => 'Words and phrases that express happiness, satisfaction, or affirmation. It looks for terms like "good," "excellent," "happy," and "great" to classify the sentiment as positive.'
        ]);
        
        Sentiment::firstOrCreate([
            'id' => 3,
            'class' => 'neutral',
            'description' => 'Language that is neither positive nor negative. It identifies phrases that are objective, factual, or indifferent, such as "average," "fine," or "okay."'
        ]);
    }
}
