<?php
// database/migrations/xxxx_create_settings_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('type')->default('string');
            $table->string('group')->default('general');
            $table->timestamps();
        });

        // Insert default settings
        $this->insertDefaultSettings();
    }

    private function insertDefaultSettings()
    {
        $defaultSettings = [
            [
                'key' => 'system_name',
                'value' => 'ELCK Southern Lake',
                'type' => 'string',
                'group' => 'general'
            ],
            [
                'key' => 'church_name',
                'value' => 'E.L.C.K Southern Lake Diocese',
                'type' => 'string',
                'group' => 'church'
            ],
            [
                'key' => 'church_email',
                'value' => 'contact@southernlake.elck.org',
                'type' => 'string',
                'group' => 'church'
            ],
            [
                'key' => 'church_phone',
                'value' => '',
                'type' => 'string',
                'group' => 'church'
            ],
            [
                'key' => 'church_address',
                'value' => '',
                'type' => 'string',
                'group' => 'church'
            ],
            [
                'key' => 'pastor_name',
                'value' => '',
                'type' => 'string',
                'group' => 'church'
            ],
            [
                'key' => 'timezone',
                'value' => 'Africa/Nairobi',
                'type' => 'string',
                'group' => 'general'
            ],
            [
                'key' => 'date_format',
                'value' => 'F j, Y',
                'type' => 'string',
                'group' => 'general'
            ],
            [
                'key' => 'items_per_page',
                'value' => '10',
                'type' => 'integer',
                'group' => 'general'
            ],
            [
                'key' => 'theme',
                'value' => 'dark',
                'type' => 'string',
                'group' => 'general'
            ],
            [
                'key' => 'dark_mode',
                'value' => '1',
                'type' => 'boolean',
                'group' => 'general'
            ],
            [
                'key' => 'email_notifications',
                'value' => '1',
                'type' => 'boolean',
                'group' => 'notifications'
            ],
            [
                'key' => 'maintenance_mode',
                'value' => '0',
                'type' => 'boolean',
                'group' => 'system'
            ],
        ];

        DB::table('settings')->insert($defaultSettings);
    }

    public function down()
    {
        Schema::dropIfExists('settings');
    }
}