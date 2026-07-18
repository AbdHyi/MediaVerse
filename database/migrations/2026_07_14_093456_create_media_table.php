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
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->foreignId('studio_id')->nullable()->constrained('studios')->nullOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->enum('type', ['film', 'series', 'anime']);
            $table->text('synopsis')->nullable();
            $table->smallInteger('release_year')->nullable();
            $table->string('poster_path')->nullable();
            $table->timestamps();

            $table->index('title');
            $table->index('type');
            $table->index('release_year');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
