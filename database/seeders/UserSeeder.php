<?php

namespace Database\Seeders;

use App\Models\User;
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
            'name' => 'Admin1',
            'email' => 'admin1@example.com',
            'password' => bcrypt('admin'),
        ]);
        User::create([
            'name' => 'Admin2',
            'email' => 'admin2@example.com',
            'password' => bcrypt('admin'),
        ]);
        User::create([
            'name' => 'Admin3',
            'email' => 'admin3@example.com',
            'password' => bcrypt('admin'),
        ]);
    }
}
