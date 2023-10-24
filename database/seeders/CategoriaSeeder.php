<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoria =[
            'nombre' => 'Bienvenido',
            'slug' => 'bienvenido',
            'status' => 1,
        ];
        
        Categoria::create($categoria);
    }
}
