<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use App\Models\Publicaciones;
use App\Models\Tag;
use App\Models\User;
use App\Models\Categoria;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Storage::deleteDirectory('posts');
        // Storage::makeDirectory('posts');

        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CategoriaSeeder::class);
        $this->call(EtiquetasSeeder::class);

        //$this->call(PublicacionesSeeder::class);
    }
}
