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
        Schema::create('recommendations', function (Blueprint $table) {
            $table->id();
            $table->decimal('budget', 12, 2);
            $table->string('kebutuhan');
            $table->foreignId('cpu_id')->constrained('cpus');
            $table->foreignId('gpu_id')->constrained('gpus');
            $table->foreignId('ram_id')->constrained('rams');
            $table->foreignId('motherboard_id')->constrained('motherboards');
            $table->foreignId('psu_id')->constrained('psus');
            $table->foreignId('storage_id')->constrained('storages');
            $table->foreignId('casing_id')->constrained('casings');
            $table->decimal('total_harga', 12, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recommendations');
    }
};
