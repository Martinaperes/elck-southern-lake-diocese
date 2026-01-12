<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExcerptColumnToNewsletterCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('newsletter_campaigns', function (Blueprint $table) {
            // Add excerpt column
            $table->string('excerpt', 500)->nullable()->after('content');
            
            // Add category column if not exists
            if (!Schema::hasColumn('newsletter_campaigns', 'category')) {
                $table->string('category', 100)->nullable()->after('excerpt');
            }
            
            // Add featured_image column if not exists
            if (!Schema::hasColumn('newsletter_campaigns', 'featured_image')) {
                $table->string('featured_image', 255)->nullable()->after('category');
            }
            
            // Add is_featured column if not exists
            if (!Schema::hasColumn('newsletter_campaigns', 'is_featured')) {
                $table->boolean('is_featured')->default(false)->after('featured_image');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('newsletter_campaigns', function (Blueprint $table) {
            $table->dropColumn(['excerpt', 'category', 'featured_image', 'is_featured']);
        });
    }
}