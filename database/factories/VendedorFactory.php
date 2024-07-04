<?php

namespace Database\Factories;

use App\Models\Vendedor;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class VendedorFactory extends Factory
{
    protected $model = Vendedor::class;

    public function definition()
    {
        return [
            'nome_vendedor' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'senha' => Hash::make('password'), 
        ];
    }
}
