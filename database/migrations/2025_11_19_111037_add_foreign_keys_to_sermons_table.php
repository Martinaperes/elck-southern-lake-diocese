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
        Schema::table('sermons', function (Blueprint $table) {
            // Add preacher_id and category_id columns if they don't exist
            if (!Schema::hasColumn('sermons', 'preacher_id')) {
                $table->foreignId('preacher_id')->nullable()->constrained()->onDelete('set null');
            }
            
            if (!Schema::hasColumn('sermons', 'category_id')) {
                $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null');
            }
            
            // Add other columns if they don't exist
            $columnsToAdd = [
                'audio_file' => 'string|nullable',
                'video_file' => 'string|nullable',
                'video_url' => 'string|nullable',
                'featured' => 'boolean|default:false',
                'status' => 'boolean|default:true'
            ];
            
            foreach ($columnsToAdd as $column => $definition) {
                if (!Schema::hasColumn('sermons', $column)) {
                    $type = explode('|', $definition)[0];
                    $default = str_contains($definition, 'default:') ? explode('default:', $definition)[1] : null;
                    
                    if ($type === 'boolean') {
                        $table->boolean($column)->default($default === 'false' ? false : true);
                    } else {
                        $table->$type($column)->nullable();
                    }
                }
            }
            
            // Add indexes
            $table->index('preacher_id');
            $table->index('category_id');
            $table->index('featured');
            $table->index('status');
            $table->index('sermon_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sermons', function (Blueprint $table) {
            // Drop foreign keys
            $table->dropForeign(['preacher_id']);
            $table->dropForeign(['category_id']);
            
            // Drop columns (optional - you might want to keep them)
            // $table->dropColumn(['preacher_id', 'category_id', 'audio_file', 'video_file', 'video_url', 'featured', 'status']);
        });
    }
};