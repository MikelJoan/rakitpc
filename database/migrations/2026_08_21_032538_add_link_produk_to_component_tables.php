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
        $tables = ['cpus', 'gpus', 'rams', 'motherboards', 'psus', 'storages', 'casings'];

        foreach ($tables as $table) {
            Schema::table($table, function (Blueprint $tableSchema) {
                $tableSchema->string('link_produk')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tables = ['cpus', 'gpus', 'rams', 'motherboards', 'psus', 'storages', 'casings'];

        foreach ($tables as $table) {
            Schema::table($table, function (Blueprint $tableSchema) {
                $tableSchema->dropColumn('link_produk');
            });
        }
    }
};
