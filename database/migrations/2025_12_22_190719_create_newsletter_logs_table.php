// database/migrations/xxxx_xx_xx_create_newsletter_logs_table.php
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('newsletter_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('campaign_id')->constrained('newsletter_campaigns')->onDelete('cascade');
            $table->foreignId('subscriber_id')->constrained('newsletter_subscribers')->onDelete('cascade');
            $table->string('status'); // sent, opened, clicked, bounced, unsubscribed
            $table->timestamp('sent_at')->nullable();
            $table->timestamp('opened_at')->nullable();
            $table->timestamp('clicked_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            
            $table->index(['campaign_id', 'subscriber_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('newsletter_logs');
    }
};