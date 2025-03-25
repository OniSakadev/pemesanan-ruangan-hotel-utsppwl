<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kamar;

class KamarSeeder extends Seeder
{
    public function run(): void
    {
        Kamar::create([
            'nama_kamar' => 'Deluxe Room',
            'kapasitas' => 2,
            'harga_per_malam' => 750000,
            'deskripsi' => 'Kamar nyaman dengan fasilitas lengkap.',
            'gambar' => null
        ]);
    }
}

