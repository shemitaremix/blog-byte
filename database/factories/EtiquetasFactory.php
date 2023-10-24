<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use app\models\Etiquetas;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class EtiquetasFactory extends Factory
{
    /**
     * Retorna el modelo correspondiente de la base de datos.
     *
     * @return \App\Models\Etiquetas
     */
    protected $model = Etiquetas::class;

     /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = $this->faker->unique()->word(20);
        return [
            'nombre' => $name,
            'slug' => Str::slug($name),
            'color' => $this->faker->randomElement(['red', 'blue', 'green', 'yellow', 'orange', 'purple', 'pink', 'grey']),
            
        ];
    }
}
