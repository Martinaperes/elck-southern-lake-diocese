<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  public function up()
{
    Schema::create('activities', function (Blueprint $table) {
        $table->id();
        $table->string('type'); // 'member_added', 'event_created', 'donation_received', etc.
        $table->text('description');
        $table->morphs('subject'); // Polymorphic: subject_id, subject_type
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->json('metadata')->nullable();
        $table->timestamp('performed_at')->useCurrent();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
