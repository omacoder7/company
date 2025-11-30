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
        Schema::create('case_study_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('case_study_id')->constrained()->onDelete('cascade');
            $table->string('locale', 2); // en, ru, az
            $table->string('title');
            $table->json('sections')->nullable();
            $table->timestamps();

            $table->unique(['case_study_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('case_study_translations');
    }
};

