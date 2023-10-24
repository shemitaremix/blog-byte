<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use app\models\Publicaciones;
use app\models\Categoria;
use app\models\User;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PublicacionesFactory extends Factory
{
   
    /**
     * Retorna el modelo correspondiente de la base de datos.
     *
     * @return \App\Models\Publicaciones
     
     */
    protected $model = Publicaciones::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = $this->faker->unique()->sentence();
        return [
            'nombre' => $name,
            'slug' => Str::slug($name),
            'tema' => $this->faker->text(250),
            'contenido' => $this->faker->text(1000),
            'status' => $this->faker->randomElement(['1', '2']),
            'categoria_id' => Categoria::all()->random()->id,
            'user_id' => User::all()->random()->id,
        ];
    }
}
