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
        Schema::create('monitored_sites', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('url')->unique();
            $table->integer('check_interval_minutes')->default(5);
            $table->boolean('is_active')->default(true);
            $table->enum('last_status', ['up', 'down'])->nullable();
            $table->timestamp('last_checked_at')->nullable();
            $table->integer('last_response_time_ms')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monitored_sites');
    }
};
