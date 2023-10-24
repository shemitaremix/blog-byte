<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use app\models\Categoria;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CategoriaFactory extends Factory
{
     /**
     * Retorna el modelo correspondiente de la base de datos.
     *
     * @return \App\Models\Categoria
     */
    protected $model = Categoria::class;

     /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $nombre = $this->faker->unique()->word(20);
        return [
            'nombre' => $nombre,
            'slug' => Str::slug($nombre),
        ];
    }
}
