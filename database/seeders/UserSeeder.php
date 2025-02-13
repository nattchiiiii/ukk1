<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
        'name' => 'natsuki',
        'email' => 'nattchi@gmail.com',
        'password' => bcrypt('password'),
        'alamat' => 'Kyoto, Japan',
        'no_hp' => '1234567890',
    ]);
    }
}
