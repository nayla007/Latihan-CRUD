<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary(); // ID sesi
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade'); // Opsional, ID pengguna
            $table->ipAddress('ip_address')->nullable(); // IP pengakses
            $table->text('user_agent')->nullable(); // User-agent pengakses
            $table->text('payload'); // Data sesi yang disimpan
            $table->integer('last_activity'); // Waktu terakhir aktivitas sesi

            // Timestamp kolom untuk created_at dan updated_at (default ada di Laravel)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
    }
};
