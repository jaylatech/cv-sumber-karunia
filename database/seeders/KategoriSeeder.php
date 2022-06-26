<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kategori::create([
            'nama' => 'Plastik'
        ]);

        Kategori::create([
            'nama' => 'Bahan Kue'
        ]);

        Kategori::create([
            'nama' => 'Kotak Kue'
        ]);
    }
}
