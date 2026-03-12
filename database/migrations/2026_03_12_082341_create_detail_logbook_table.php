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
        Schema::create('detail_logbook', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('logbook_id');
            $table->string('no', 50)->nullable()->default('');
            $table->string('waktu', 50)->nullable()->default('');
            $table->string('aktivitas', 50)->nullable()->default('');
            $table->string('proyek', 50)->nullable()->default('');
            $table->string('deskripsi', 50)->nullable()->default('');
            $table->string('output', 50)->nullable()->default('');
            $table->string('pekerja', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_logbook');
    }
};
