<?php

namespace Database\Factories;

use App\Empresa;
use App\Models\Empresa as ModelsEmpresa;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmpresaFactory extends Factory
{
    protected $model = ModelsEmpresa::class;

    public function definition(): array
    {
    	return [
    	    "numero_identificacao" => $this->faker->numberBetween(10000000, 99999999),
            "email"                => $this->faker->companyEmail(),
            "nome_fantasia"        => $this->faker->name(),
            "nome_responsavel"     => $this->faker->name(),
            "telefone"             => $this->faker->e164PhoneNumber(),
            "codigo_postal"        => $this->faker->postcode(),
            "numero"               => $this->faker->numberBetween(100, 999),
            "rua"                  => $this->faker->streetName(),
            "bairro"               => $this->faker->cityPrefix(),
            "cidade"               => $this->faker->city(),
            "estado"               => $this->faker->streetSuffix(),
            "pais"                 => $this->faker->country(),
    	];
    }
}
