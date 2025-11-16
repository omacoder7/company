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
        Schema::create('developer_applications', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('contact'); // email or telegram
            $table->string('stack')->nullable();
            $table->string('github')->nullable();
            $table->string('portfolio')->nullable();
            $table->text('message')->nullable();
            $table->boolean('is_processed')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('developer_applications');
    }
};
