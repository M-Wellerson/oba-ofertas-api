<?php

namespace Database\Factories;

use App\Categoria;
use App\Models\Categoria as ModelsCategoria;
use Faker\Provider\DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoriaFactory extends Factory
{
    protected $model = ModelsCategoria::class;

    public function definition(): array
    {
    	return [
    	    "nome"       => $this->faker->name,
            "descricao"  => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
    	];
    }
}
