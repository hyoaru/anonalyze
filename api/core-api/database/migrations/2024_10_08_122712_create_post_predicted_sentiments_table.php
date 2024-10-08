<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('post_predicted_sentiments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sentiment_id')->constrained('sentiments')->onDelete('cascade');
            $table->float('probability');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_predicted_sentiments');
    }
};
