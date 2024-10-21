<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('disease_id')
                ->nullable()
                ->constrained('diseases')
                ->cascadeOnDelete();
            $table->string('name', 70);
            $table->string('type', 30);
            $table->dateTime('start_at');
            $table->dateTime('end_at')->nullable();
            $table->json('days');
            $table->time('daily_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
