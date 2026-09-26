<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class buku extends Model
{
   protected $table = 'buku';
   protected $fillable = [
    'judul',
    'penulis',
    'harga',
    'tgl_terbit',
    'cover',
    'penerbit',
    'genre',
];
}
