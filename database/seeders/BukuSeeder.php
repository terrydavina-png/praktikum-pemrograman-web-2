<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Buku;
use Faker\Factory as Faker;

class BukuSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        for ($i = 0; $i < 20; $i++) {
            Buku::create([
                'judul' => $faker->sentence(3),
                'penulis' => $faker->name(),
                'harga' => $faker->numberBetween(20000, 150000),
                'tgl_terbit' => $faker->date(),
                'cover' => null,
                'penerbit' => $faker->company(),
                'genre' => $faker->randomElement([
                    'Fiksi',
                    'Nonfiksi',
                    'Pendidikan',
                    'Anak-anak',
                    'Komik',
                ]),
            ]);
        }
    }
}