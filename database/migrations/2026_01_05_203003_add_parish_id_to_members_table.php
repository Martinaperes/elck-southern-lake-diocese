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
    Schema::table('members', function (Blueprint $table) {
        $table->foreignId('parish_id')->nullable()->constrained()->onDelete('set null');
        
        // Optional: Add index for better performance
        $table->index('parish_id');
    });
}

public function down()
{
    Schema::table('members', function (Blueprint $table) {
        $table->dropForeign(['parish_id']);
        $table->dropColumn('parish_id');
    });
}
};
