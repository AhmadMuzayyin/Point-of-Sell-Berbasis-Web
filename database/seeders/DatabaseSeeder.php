<?php

namespace Database\Seeders;

use App\Models\User;
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
            'name' => "Administrator",
            'username' => "admin",
            'password' => bcrypt("123"),
            'alamat' => "Pamekasan",
            'jenis_kelamin' => "Laki-Laki",
            'no_telepon' => "0812345678",
            'status' => 1
        ]);
    }
}
