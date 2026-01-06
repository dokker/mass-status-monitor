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
        Schema::create('status_checks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('monitored_site_id')->constrained('monitored_sites')->onDelete('cascade'); // auto-deletes checks when site is deleted
            $table->enum('status', ['up', 'down']);
            $table->integer('response_time_ms')->nullable();
            $table->integer('http_status_code')->nullable();
            $table->text('error_message')->nullable();
            $table->timestamp('checked_at');            
            $table->timestamps();
            $table->index(['monitored_site_id', 'checked_at']); // crucial for fast 24h queries
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_checks');
    }
};
