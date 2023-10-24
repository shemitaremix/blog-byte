<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Imagen;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ImagenFactory extends Factory
{
    /**
     * Retorna el modelo correspondiente de la base de datos.
     *
     * @return \App\Models\Imagen
     */
    protected $model = Imagen::class;

   /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'url' => 'posts/' . $this->faker->image('public/storage/posts',400,300, null, false),
        ];
    }
}
