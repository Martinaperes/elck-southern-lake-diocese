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
    Schema::create('ministry_members', function (Blueprint $table) {
        $table->id();
        $table->foreignId('ministry_id')->constrained()->onDelete('cascade');
        $table->foreignId('member_id')->constrained()->onDelete('cascade');
        $table->string('role')->nullable();
        $table->date('joined_at')->nullable();
        $table->boolean('is_active')->default(true);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ministry_members');
    }
};
