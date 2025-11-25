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
        Schema::table('ministries', function (Blueprint $table) {
            // Choose ONE of these options:
            
            // Option 1: Simple single image column
            $table->string('image_path')->nullable()->after('meeting_schedule');
            
            // Option 2: Multiple image columns (uncomment if needed)
            // $table->string('featured_image')->nullable()->after('meeting_schedule');
            // $table->string('banner_image')->nullable()->after('featured_image');
            // $table->string('thumbnail_image')->nullable()->after('banner_image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ministries', function (Blueprint $table) {
            // Remove the columns if rolling back
            $table->dropColumn(['image_path']);
            
            // If using Option 2, use this instead:
            // $table->dropColumn(['featured_image', 'banner_image', 'thumbnail_image']);
        });
    }
};