<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{

    private $SUPER_ADMIN = 1;
    private $ADMIN = 2;
    private $CUSTOMER = 3;
    private $PEMILIK = 4;
    private $GUDANG = 5;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin = User::create([
            'name' => 'Super Admin User',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('12345678'),
            'username' => 'superadmin',
            'jenis_kelamin' => 'L',
            'telepon' => '123456789',
            'alamat' => 'Cluring',
            'tanggal_lahir' => '24-08-1999',
            'member' => false
        ]);
        $superAdmin->roles()->attach($this->SUPER_ADMIN);

        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'username' => 'admin',
            'jenis_kelamin' => 'L',
            'telepon' => '123456789',
            'alamat' => 'Srono',
            'tanggal_lahir' => '25-08-1999',
            'member' => false
        ]);
        $admin->roles()->attach($this->ADMIN);

        $customer = User::create([
            'name' => 'Customer User',
            'email' => 'customer@gmail.com',
            'password' => Hash::make('12345678'),
            'username' => 'customer',
            'jenis_kelamin' => 'L',
            'telepon' => '123456789',
            'alamat' => 'Rogojampi',
            'tanggal_lahir' => '26-08-1999',
            'member' => false
        ]);
        $customer->roles()->attach($this->CUSTOMER);

        $pemilik = User::create([
            'name' => 'Pemilik User',
            'email' => 'pemilik@gmail.com',
            'password' => Hash::make('12345678'),
            'username' => 'pemilik',
            'jenis_kelamin' => 'P',
            'telepon' => '123456789',
            'alamat' => 'Rogojampi',
            'tanggal_lahir' => '27-08-1999',
            'member' => false
        ]);
        $pemilik->roles()->attach($this->PEMILIK);

        $gudang = User::create([
            'name' => 'Gudang User',
            'email' => 'gudang@gmail.com',
            'password' => Hash::make('12345678'),
            'username' => 'gudang',
            'jenis_kelamin' => 'L',
            'telepon' => '123456789',
            'alamat' => 'Glagah',
            'tanggal_lahir' => '28-08-1999',
            'member' => false
        ]);
        $gudang->roles()->attach($this->GUDANG);
    }
}
