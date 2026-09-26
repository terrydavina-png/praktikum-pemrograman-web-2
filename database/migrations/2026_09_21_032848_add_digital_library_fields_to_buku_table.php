<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('buku', function (Blueprint $table) {
            $table->string('cover')->nullable();
            $table->string('penerbit')->nullable();
            $table->string('genre')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('buku', function (Blueprint $table) {
            $table->dropColumn([
                'cover',
                'penerbit',
                'genre',
            ]);
        });
    }
};

