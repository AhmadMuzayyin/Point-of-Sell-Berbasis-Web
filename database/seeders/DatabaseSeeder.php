<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => "Ahmad Muzayyin",
            'username' => "admin",
            'password' => bcrypt("123"),
            'status' => 1
        ]);
        User::create([
            'name' => "Zainal Fatah",
            'username' => "kasir",
            'password' => bcrypt("123"),
            'status' => 2
        ]);
        Setting::create([
            'nama' => "Toko",
            'alamat' => "Ganding Sumenep",
            'kontak' => "123456789",
            'logo' => 'logo-toko.png',
            'nota' => 1
        ]);

        $c1 = Category::create([
            'kategori' => 'Kilo',
            'jenis' => 'Buah'
        ]);
        $c2 = Category::create([
            'kategori' => 'Bungkus',
            'jenis' => 'Plastik'
        ]);

        Product::create([
            'category_id' => $c1->id,
            'nama' => 'Apel',
            'merek' => 'Buah Manis',
            'diskon' => 5,
            'harga_beli' => 10000,
            'harga_jual' => 12000,
            'harga_jual_opsi' => 11000,
            'stok' => 100,
        ]);
        Product::create([
            'category_id' => $c2->id,
            'nama' => 'Sterofom',
            'merek' => 'Gajah Duduk',
            'diskon' => 5,
            'harga_beli' => 10000,
            'harga_jual' => 12000,
            'harga_jual_opsi' => 0,
            'stok' => 100,
        ]);
    }
}
