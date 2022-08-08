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
            'name' => 'Graphic App',
            'role' => 1,
            'email' => 'graphic@gmail.com',
            'password' => bcrypt('graphic')
        ]);
    }
}
