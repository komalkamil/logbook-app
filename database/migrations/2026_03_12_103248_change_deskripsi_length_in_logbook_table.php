<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('detail_logbook', function (Blueprint $table) {
            $table->string('deskripsi', 255)->change();
        });
    }

    public function down(): void
    {
        Schema::table('detail_logbook', function (Blueprint $table) {
            $table->string('deskripsi', 50)->change();
        });
    }
};
