<?php

namespace Database\Factories;

use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;

class UsuarioFactory extends Factory
{
    protected $model = Usuario::class;

    public function definition(): array
    {
    	return [
    	    'nome'     => $this->faker->name,
    	    'password' => app('hash')->make($this->faker->password),
    	    'foto'     => $this->faker->imageUrl($width = 640, $height = 480),
            'email'    => $this->faker->unique()->safeEmail,
    	];
    }
}
