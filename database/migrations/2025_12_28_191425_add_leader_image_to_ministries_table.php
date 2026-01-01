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
        $table->string('leader_image')->nullable()->after('leader_name');
    });
}

public function down(): void
{
    Schema::table('ministries', function (Blueprint $table) {
        $table->dropColumn('leader_image');
    });
}

};
