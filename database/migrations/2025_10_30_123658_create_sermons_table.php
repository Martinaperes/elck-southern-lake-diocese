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
        // database/migrations/2024_01_01_000005_create_sermons_table.php
    Schema::create('sermons', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->text('description')->nullable();
    $table->text('scripture_references')->nullable();#book of the Bible
    $table->string('preacher');
    $table->date('sermon_date');
    $table->string('audio_url')->nullable();
    $table->string('video_url')->nullable();
    $table->string('document_url')->nullable();
    $table->integer('duration_minutes')->nullable();
    $table->boolean('is_published')->default(false);
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sermons');
    }
};
