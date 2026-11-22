<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Jaga-jaga kalau tabel posts belum ada
        if (! Schema::hasTable('posts')) {
            Schema::create('posts', function (Blueprint $table) {
                $table->id();
                $table->string('title', 200);
                $table->timestamps();
            });
        }

        Schema::table('posts', function (Blueprint $table) {
            if (! Schema::hasColumn('posts', 'description')) {
                $table->mediumText('description')->nullable();
            }
            if (! Schema::hasColumn('posts', 'picture')) {
                $table->string('picture')->nullable();
            }
            if (! Schema::hasColumn('posts', 'id_buku')) {
                $table->foreignId('id_buku')->nullable()
                      ->constrained('buku')->cascadeOnDelete();
            }
        });

        // Tabel posts lama punya kolom content yang wajib diisi,
        // padahal form galeri tidak memakainya
        if (Schema::hasColumn('posts', 'content')) {
            Schema::table('posts', function (Blueprint $table) {
                $table->text('content')->nullable()->change();
            });
        }
    }

    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            if (Schema::hasColumn('posts', 'id_buku')) {
                $table->dropConstrainedForeignId('id_buku');
            }
            $table->dropColumn(['description', 'picture']);
        });
    }
};