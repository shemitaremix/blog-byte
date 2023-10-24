<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Etiquetas; 

class EtiquetasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $etiqueta =[
            'nombre' => 'Bienveniido',
            'slug' => 'bienvenido',
            'color' => 'white',
            'status' => 1,
        ];
        //subier la etiqueta a la base de datos
        Etiquetas::create($etiqueta);
    }
}
