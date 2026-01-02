<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ministry_members', function (Blueprint $table) {
            $table->json('notes')->nullable()->after('is_active');
        });
    }

    public function down(): void
    {
        Schema::table('ministry_members', function (Blueprint $table) {
            $table->dropColumn('notes');
        });
    }
};