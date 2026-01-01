<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('newsletter_subscribers', function (Blueprint $table) {
            $table->string('parish')->nullable()->after('email');
        });
    }

    public function down()
    {
        Schema::table('newsletter_subscribers', function (Blueprint $table) {
            $table->dropColumn('parish');
        });
    }
};
