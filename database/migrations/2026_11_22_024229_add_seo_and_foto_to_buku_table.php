<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('buku', function (Blueprint $table) {
            $table->string('buku_seo')->nullable()->unique()->after('judul');
            $table->string('foto')->nullable()->after('cover');
        });

        // Isi slug untuk buku yang sudah ada
        $dipakai = [];
        foreach (DB::table('buku')->get() as $b) {
            $slug = Str::slug($b->judul);
            if ($slug === '' || in_array($slug, $dipakai)) {
                $slug = ($slug ?: 'buku') . '-' . $b->id;
            }
            $dipakai[] = $slug;
            DB::table('buku')->where('id', $b->id)->update(['buku_seo' => $slug]);
        }
    }

    public function down(): void
    {
        Schema::table('buku', function (Blueprint $table) {
            $table->dropColumn(['buku_seo', 'foto']);
        });
    }
};