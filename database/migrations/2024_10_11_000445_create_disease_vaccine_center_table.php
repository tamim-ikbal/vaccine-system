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
        Schema::create('disease_vaccine_center', function (Blueprint $table) {
            $table->foreignId('disease_id')->constrained('diseases')
                ->cascadeOnDelete();
            $table->foreignId('vaccine_center_id')->constrained('vaccine_centers')
                ->cascadeOnDelete();
            $table->unsignedInteger('daily_limit')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disease_vaccine_center');
    }
};
