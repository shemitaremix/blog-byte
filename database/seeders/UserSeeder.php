<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

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
            'name' => 'shemita Remix',
            'email' => 'shemarodriguez1406@gmail.com',
            'password' => bcrypt('123456'),
        ])->assignRole('admin');

        User::create([
            'name' => 'Eric Kevin',
            'email' => 'kevinhalo005@gmail.com',
            'password' => bcrypt('hola1234'),
        ])->assignRole('superAdmin');

        User::create([
            'name' => 'Emmanuel Torres',
            'email' => 'emmanuel.torres@deinsi.com',
            'password' => bcrypt('123456'),
        ])->assignRole('superAdmin');

        User::create([
            'name' => 'Cristian Bautista',
            'email' => 'crisbautista311@gmail.com',
            'password' => bcrypt('123123123'),
        ])->assignRole('superAdmin');

        
    }
}
