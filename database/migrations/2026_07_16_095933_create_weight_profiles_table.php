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
        Schema::create('weight_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('kebutuhan');
            $table->decimal('bobot_cpu', 4, 2);
            $table->decimal('bobot_gpu', 4, 2);
            $table->decimal('bobot_ram', 4, 2);
            $table->decimal('bobot_storage', 4, 2);
            $table->decimal('bobot_psu', 4, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weight_profiles');
    }
};
