<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * customer — original schema preserved.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customer', function (Blueprint $table) {
            $table->string('id_customer', 10)->primary();
            $table->string('nama_customer', 100);
            $table->string('nama_pt', 100)->nullable();
            $table->string('alamat_pt', 255)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customer');
    }
};
