<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Buku extends Model
{
    protected $table = 'buku';

    protected $fillable = [
        'judul', 'buku_seo', 'penulis', 'harga', 'tgl_terbit',
        'cover', 'foto', 'penerbit', 'genre', 'pdf',
    ];

    protected $casts = [
        'tgl_terbit' => 'date',
    ];

    // Satu buku punya banyak foto galeri
    public function photos(): HasMany
    {
        return $this->hasMany(Post::class, 'id_buku');
    }
}