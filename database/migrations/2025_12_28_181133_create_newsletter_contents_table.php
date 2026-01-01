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
    Schema::create('newsletter_contents', function (Blueprint $table) {
        $table->id();
        $table->string('title'); // e.g., "Weekly Sermons", "Upcoming Events"
        $table->text('content')->nullable(); // content/body of that section
        $table->string('image')->nullable(); // optional image
        $table->string('link')->nullable(); // optional link for more info
        $table->integer('order')->default(0); // order of display
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('newsletter_contents');
    }
};
