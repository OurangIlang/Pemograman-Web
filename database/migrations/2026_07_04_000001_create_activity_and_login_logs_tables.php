<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Audit-trail tables added for the activity/login logging feature.
 *
 * activity_logs — records every create/update/delete on the tracked
 * master & transaction models (who did what, and the before/after
 * values for updates).
 *
 * login_logs — records every login/logout (who, when, from where).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('nama_user')->nullable();
            $table->string('role', 20)->nullable();
            $table->string('aktivitas', 50); // Tambah | Ubah | Hapus
            $table->string('tabel', 100);
            $table->string('record_id', 100)->nullable();
            $table->longText('data_lama')->nullable();
            $table->longText('data_baru')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('login_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('nama_user')->nullable();
            $table->string('role', 20)->nullable();
            $table->timestamp('login_at')->nullable();
            $table->timestamp('logout_at')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamp('created_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
        Schema::dropIfExists('login_logs');
    }
};
