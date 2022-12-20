<?php

namespace Database\Factories;

use App\Models\Perro;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Perro>
 */
class PerroFactory extends Factory
{
    protected $model = Perro::class;
    public function definition()
    {
        return [
            
            "nombre"=>$this->faker->name,
            "url_foto" => $this->faker->imageUrl,
            "descripcion" => $this->faker->sentence
        ];
    }
}
