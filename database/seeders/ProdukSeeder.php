<?php

namespace Database\Seeders;

use App\Models\Produk;
use App\Models\Stok;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    private $PLASTIK = 1;
    private $BAHAN_KUE = 2;
    private $KOTAK_KUE = 3;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $produk1 = Produk::create([
            'kode_produk' => random_int(1000000, 9999999),
            'nama' => 'Plastik 1',
            'harga' => '2000',
            'berat' => '120',
            'masa_penyimpanan' => '90',
            'deskripsi' => 'Deskripsi Plastik 1'
        ]);
        $produk1_stok = Stok::create(['stok' => 220]);
        $produk1->kategoris()->attach($this->PLASTIK);
        $produk1->stok()->save($produk1_stok);

        $produk2 = Produk::create([
            'kode_produk' => random_int(1000000, 9999999),
            'nama' => 'Plastik 2',
            'harga' => '2300',
            'berat' => '130',
            'masa_penyimpanan' => '90',
            'deskripsi' => 'Deskripsi Plastik 2'
        ]);
        $produk2_stok = Stok::create(['stok' => 115]);
        $produk2->kategoris()->attach($this->PLASTIK);
        $produk2->stok()->save($produk2_stok);

        $produk3 = Produk::create([
            'kode_produk' => random_int(1000000, 9999999),
            'nama' => 'Plastik 3',
            'harga' => '2500',
            'berat' => '120',
            'masa_penyimpanan' => '90',
            'deskripsi' => 'Deskripsi Plastik 3'
        ]);
        $produk3_stok = Stok::create(['stok' => 212]);
        $produk3->kategoris()->attach($this->PLASTIK);
        $produk3->stok()->save($produk3_stok);


        // Bahan Kue
        $produk4 = Produk::create([
            'kode_produk' => random_int(1000000, 9999999),
            'nama' => 'Bahan Kue 1',
            'harga' => '5000',
            'berat' => '300',
            'masa_penyimpanan' => '90',
            'deskripsi' => 'Bahan Kue 1'
        ]);
        $produk4_stok = Stok::create(['stok' => 120]);
        $produk4->kategoris()->attach($this->BAHAN_KUE);
        $produk4->stok()->save($produk4_stok);

        $produk5 = Produk::create([
            'kode_produk' => random_int(1000000, 9999999),
            'nama' => 'Bahan Kue 2',
            'harga' => '5000',
            'berat' => '500',
            'masa_penyimpanan' => '90',
            'deskripsi' => 'Bahan Kue 2'
        ]);
        $produk5_stok = Stok::create(['stok' => 152]);
        $produk5->kategoris()->attach($this->BAHAN_KUE);
        $produk5->stok()->save($produk5_stok);

        $produk6 = Produk::create([
            'kode_produk' => random_int(1000000, 9999999),
            'nama' => 'Bahan Kue 3',
            'harga' => '5500',
            'berat' => '550',
            'masa_penyimpanan' => '90',
            'deskripsi' => 'Bahan Kue 3'
        ]);
        $produk6_stok = Stok::create(['stok' => 245]);
        $produk6->kategoris()->attach($this->BAHAN_KUE);
        $produk6->stok()->save($produk6_stok);


        // Kotak Kue
        $produk7 = Produk::create([
            'kode_produk' => random_int(1000000, 9999999),
            'nama' => 'Kotak Kue 1',
            'harga' => '5000',
            'berat' => '400',
            'masa_penyimpanan' => '90',
            'deskripsi' => 'Kotak Kue 1'
        ]);
        $produk7_stok = Stok::create(['stok' => 201]);
        $produk7->kategoris()->attach($this->KOTAK_KUE);
        $produk7->stok()->save($produk7_stok);

        $produk8 = Produk::create([
            'kode_produk' => random_int(1000000, 9999999),
            'nama' => 'Kotak Kue 2',
            'harga' => '6000',
            'berat' => '350',
            'masa_penyimpanan' => '90',
            'deskripsi' => 'Kotak Kue 2'
        ]);
        $produk8_stok = Stok::create(['stok' => 155]);
        $produk8->kategoris()->attach($this->KOTAK_KUE);
        $produk8->stok()->save($produk8_stok);

        $poduk9 = Produk::create([
            'kode_produk' => random_int(1000000, 9999999),
            'nama' => 'Kotak Kue 3',
            'harga' => '7000',
            'berat' => '450',
            'masa_penyimpanan' => '90',
            'deskripsi' => 'Kotak Kue 3'
        ]);
        $poduk9_stok = Stok::create(['stok' => 261]);
        $poduk9->kategoris()->attach($this->KOTAK_KUE);
        $poduk9->stok()->save($poduk9_stok);
    }
}
