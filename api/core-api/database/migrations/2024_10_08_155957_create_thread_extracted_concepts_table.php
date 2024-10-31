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
        Schema::create('thread_extracted_concepts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('thread_extracted_concept_group_id');
            $table->string('concept');
            $table->float('significance_score');
            $table->timestamps();

            $table->foreign('thread_extracted_concept_group_id', 'thread_extracted_concept_group_id_fk')
                ->references('id')
                ->on('thread_extracted_concept_groups')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thread_extracted_concepts');
    }
};
